<div class="modal fade {{$size}}" id="{{$id}}" tabindex="-1" aria-labelledby="{{$id}}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-2 p-3">
        <div class="modal-header">
          <h5 class="modal-title" id="{{$id}}Label">{{$title}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{$slot}}
      </div>
    </div>
</div>