@extends('admin.master')
@section('title')
One To One Relation
@endsection
@section('content')
<!-- Modal HTML Markup -->
<!-- Button trigger modal -->
<div class="card">
    <div class="card-body">
        <h4>
            Phone Date
            <button type="button" class="btn btn-sm btn-primary text-center mt-3 float-end"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add Phone
            </button>
        </h4>
    </div>
  </div>
      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Add Phone</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('new.phone')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Phone Name</label>
                        <input type="text" class="form-control @error('phone_name') is-invalid @enderror"  name="phone_name">

                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                      <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1"  name="description" rows="3"></textarea>
                      </div>
                      <button type="submit" class="btn btn-sm btn-info">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              {{-- <a type="submit" class="btn btn-primary">Submit</button> --}}
            </div>
          </div>
        </div>
      </div>

      {{-- -----Edit Modal---- --}}
      <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Edit Phone</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('update.phone')}}" method="post">
                    @csrf
                    {{-- @method('PUT') --}}
                    <input type="hidden" id="phone_id" class="form-control" name="phone_id">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Phone Name</label>
                        <input type="text" class="form-control"  id="phone_name" name="phone_name" >
                        {{-- @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror --}}
                    </div>
                      <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" id="description"  name="description" rows="3"></textarea>
                      </div>
                      <button type="submit" class="btn btn-sm btn-info">Update</button>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
        {{-- ----------End Edit Modal---- --}}
      <div class="card" >
        <div class="card-body">
            <table class="table table-hover table-dark">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <thead>
                  <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Phone Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                    @php
                        $i =1;
                    @endphp
                    @forelse ($phones as $phone)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$phone->phone_name}}</td>
                    <td>{{$phone->description}}</td>
                    <td>
                        <div class="d-flex p-2">
                            <button type="button" value="{{$phone->id}}" class="btn btn-sm editbtn btn-info">Edit</button>
                            {{-- <a href="{{route('phone.edit',['id'=>$phone->id])}}" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editModal">Edit</a> --}}
                        <form action="{{route('phone.delete')}}" method="post">
                            @csrf
                            <input type="hidden" name="phone_id" value="{{$phone->id}}">
                            <button type="submit" class="btn btn-sm btn-danger ms-2 me-2" onclick="return confirm('Are you sure Delete This!!')">Delete</button>
                        </form>
                        </div>
                    </td>
                    @empty
                    No Date
                    @endforelse
                  </tr>
                </tbody>
              </table>
        </div>
      </div>
@endsection

@section('script')
<script>
    $( document ).ready(function() {
        $(document) .on('click','.editbtn', function(){
            var phone_id = $(this).val();
            // alert(phone_id);
            $('#editModal').modal('show');
            $.ajax({
                type: "GET",
                url: "/edit-phone/"+phone_id,
                success: function(response) {
                    // console.log(response.phones.phone_name);
                    $('#phone_name').val(response.phones.phone_name);
                    $('#description').val(response.phones.description);
                    $('#phone_id').val(phone_id);

                }

            })
        });

    });
</script>
@endsection

