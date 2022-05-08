{{-- <div class="modal fade" id="modal_{{ $id }}" tabindex="-1" role="dialog"
    aria-labelledby="modal_{{ $id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        ازالة العنصر
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد من ازالة ذلك ؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>
                    <form action="{{ $route }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">نعم</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div> --}}
<!-- Modal -->
<div class="modal fade" id="modal_{{ $id }}" tabindex="-1" aria-labelledby="modal_{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_{{ $id }}Label">
            ازالة العنصر
            </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            هل أنت متأكد من ازالة ذلك ؟
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لا</button>
          <form action="{{ $route }}" method="POST">
            <input type="hidden" name="page" value="{{ request('page') }}">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">نعم</button>
        </form>
        </div>
      </div>
    </div>
  </div>
