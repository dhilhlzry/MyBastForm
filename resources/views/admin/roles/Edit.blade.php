@foreach($role as $datas)
<div class="modal fade" id="Edit{{$datas->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel"></h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mr-3 ml-3">
        <form action="{{route('roles.update', $datas->id) }}" method="post">
          @csrf
          @if ($datas)
          @method('PUT')
          @endif

          <div class="form-group mb-5">
            <label for="exampleInputEmail1" style="color: rgb(143,156,170);">ROLE NAME</label>
            <input type="text" name="name" class="form-control nameRole" aria-describedby="emailHelp" placeholder="Enter a role name" value="{{$datas->name}}">
          </div>
          <div class="form-group">
            <div class="d-flex justify-content-between">
              <label class="mb-3" style="color: rgb(120,120,120);">ROLE PERMISSIONS</label>
            </div>
            <div class="table-responsive">
              <table class="table">
                <tbody>
                  @foreach($permissions as $data => $permission)
                  <tr>
                    <td style="font-weight: 700;color: rgb(120,120,120);width: 40%;">Feature {{$permission['name']}}</td>
                    <td>
                      <div class="d-flex" style="gap:45px;">
                        @foreach($permission['feature'] as $key => $data)
                        <div class="checkbox-wrapper-33">
                          <label class="checkbox" style="cursor: pointer;">

                            <input class="check checkbox__trigger visuallyhidden editCheck" name="permission[]" value="{{$permission['slug']}}-{{$key}}" type="checkbox" {{$datas->hasPermissionTo($permission['slug'].'-'.$key) ? 'checked' : ''}} />

                            <span class="checkbox__symbol">
                              <svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 14l8 7L24 7"></path>
                              </svg>
                            </span>
                            <p class="checkbox__textwrapper" style="color: rgb(143,156,170);">{{$key}}</p>
                          </label>
                        </div>
                        @endforeach
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelButton">Cancel</button>
            <button type="submit" class="btn custom-Button">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach