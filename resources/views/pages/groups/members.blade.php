@extends('layouts.master')
@section('content')
    <div class="col-md w-lg w-auto-sm light lt b-l">
        <div class="p-a b-b">

              <span class="w-40 circle purple avatar ">
                <span>G</span>
                <i class="busy b-white"></i>
              </span>
            {{"Members of ".$group->name}}
        </div>

        <div class="list-group no-radius no-borders light lt">

            @foreach($group->users as $user)
                <div class="box-body " style="border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
">
                <div class="flex">
                    <div  href="{{route('profile',$user->id)}}"   class="list-group-item p-x-md text-ellipsis">
                    <img src="../{{$user->profile_picture}}" class="w-24 m-r-sm img-circle">
                        <span>{{$user->name}}</span>
                        @if($user->id ==$group->owner_id)
                            <span class="label label-sm red  pull-left ml-3 ">{{"isOwner"}}</span>

                    @elseif($user->isAdminOfGroup($group->id))
                    <span class="label label-sm warn  pull-left ml-3 ">{{"isAdmin"}}</span>
                    @endif
                   @if(auth()->user()->isAdminOfGroup($group->id) && !$user->isAdminOfGroup($group->id))
                        <form action="{{ route('member.delete', ['group' => $group->id, 'user' => $user->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to remove this user?')">
                                Delete
                            </button>
                        </form>

                        @endif


                        @if(auth()->id() == $group->owner_id && $user->id !=$group->owner_id && $user->isAdminOfGroup($group->id))

                            <form action="{{ route('groups.revokeUserAdmin', ['group' => $group->id, 'user' => $user->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit">
                                     Revoke Admin
                                </button>
                            </form>
                            <form action="{{ route('member.delete', ['group' => $group->id, 'user' => $user->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to remove this user?')">
                                    Delete
                                </button>
                            </form>
                        @endif
                            @if(auth()->id() == $group->owner_id && $user->id !=$group->owner_id && !$user->isAdminOfGroup($group->id))
                            <form action="{{ route('groups.makeUserAdmin', ['group' => $group->id, 'user' => $user->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit">
                                    make as Admin
                                </button>
                            </form>

                      @endif
                </div>
                </div>
                </div>
            @endforeach

        </div>

    </div>

    </div>
    <a   class="btn-btn-primary" href="{{route('group.show',$group->id)}}">back to group</a>
@endsection
