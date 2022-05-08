require("./bootstrap");

function fileSys() {
    $(".files").on("click", function () {
        $(this).parent().find(".input_files").click();
    });
    $(".input_files").on("change", function () {
        let filesBtn = $(this).parent().find(".files");
        let imgs = $(this).parent().find(".imgs");

        imgs.empty();
        let files = this.files;
        if ($(this).data("img")) {
            if (files.length > $(this).data("img")) {
                $(this)[0].value = "";
                $(this).parent().find(".file_error").removeAttr("hidden");
            } else {
                $(this).parent().find(".file_error").attr("hidden", "");
                for (let i = 0; i < files.length; i++) {
                    let fileReader = new FileReader();
                    fileReader.readAsDataURL(files[i]);
                    fileReader.onload = function (event) {
                        let img = document.createElement("img");
                        img.src = event.target.result;
                        imgs.append(img);
                    };
                    if (files.length > 2) {
                        filesBtn.text(files.length);
                    } else {
                        if (files[0].name.length > 15) {
                            filesBtn.text(
                                files[0].name.substring(0, 15) + "..."
                            );
                        } else {
                            filesBtn.text(files[0].name);
                        }
                    }
                }
            }
        } else {
            for (let i = 0; i < files.length; i++) {
                let fileReader = new FileReader();
                fileReader.readAsDataURL(files[i]);
                fileReader.onload = function (event) {
                    let img = document.createElement("img");
                    img.src = event.target.result;
                    imgs.append(img);
                };
                if (files.length > 2) {
                    filesBtn.text(files.length);
                } else {
                    if (files[0].name.length > 15) {
                        filesBtn.text(files[0].name.substring(0, 15) + "...");
                    } else {
                        filesBtn.text(files[0].name);
                    }
                }
            }
        }
    });
}
$(".btn-default").text("تحديد");

fileSys();

if (window.matchMedia("(max-width: 991px)").matches) {
    $(".frontend .front-page-content").css({
        marginTop: `${$(".frontend .navbar").height()}px`,
    });
} else {
    $(".frontend .front-page-content").css({
        marginTop: `${$(".frontend .navbar").height()}px`,
    });
}
