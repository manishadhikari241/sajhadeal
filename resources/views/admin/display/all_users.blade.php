@extends('admin.layout.master')

@section('styles')
    <style>
        .results tr[visible='false'],
        .no-result {
            display: none;
        }

        .results tr[visible='true'] {
            display: table-row;
        }

        .counter {
            padding: 8px;
            color: #ccc;
        }
    </style>
@endsection

@section('content')

    <div class="container box">
        <div class="row justify-content-center">
            <div class="col-md-10">


                <div class="center">
                    <h3>Customers</h3>
                    @if(session('success'))
                    <span class="alert alert-success">{{ session('success') }}</span>
                    @endif
                </div>
                <div class="form-group pull-right">
                    <input type="text" class="search form-control" placeholder="Search for?">
                </div>
                <span class="counter pull-right"></span>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered results">
                        <thead>
                        <tr class="table-info">
                            <th>ID</th>
                            <th class="">Full Name</th>
                            <th class="">EMail</th>
                            <th class="">Phone</th>
                            <th>Created</th>
                            <th>Last Login</th>
                            <th>Role</th>
                        </tr>
                        <tr class="warning no-result">
                            <td colspan="4"><i class="fa fa-warning"></i> No result</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ isset($user->admin) ? $user->admin->first_name : ''}}&nbsp;{{ isset($user->admin) ? $user->admin->last_name: ''}}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ isset($user->admin) ? $user->admin->mobile : '' }}</td>
                                <td>{{ substr($user->created_at,0,10) }}</td>
                                <td>{{ substr($user->last_login,0,10) }}
                                    at {{ substr($user->last_login,11) }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        {{ $role->name }} .
                                    @endforeach
                                    <i class="fa fa-edit" style="font-size:24px" data-toggle="modal"
                                       data-target="#role_modal{{ $user->id }}" title="Edit Role"></i>
                                    <div class="modal fade" id="role_modal{{ $user->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('edit_role',$user->id) }}" method="post">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit
                                                            Role</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered table-features">
                                                            <thead>
                                                            <tr>
                                                                <th>SN</th>
                                                                <th>Roles</th>
                                                                <!--<th>Action</th>-->
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($user->roles as $role)
                                                                <tr>
                                                                    <td> #</td>
                                                                    <td>
                                                                        <select name="roles[{{$role->id}}]"
                                                                                class="form-control"
                                                                                style="height:auto">
                                                                            @foreach($roles as $a_role)
                                                                                <option value="{{$a_role->id}}"
                                                                                        @if($role->id == $a_role->id) selected @endif
                                                                                >{{ $a_role->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <!--<td>-->
                                                                    <!--    <button type="button"-->
                                                                    <!--            class="btn btn-danger btn-sm btn-delete-features"-->
                                                                    <!--            data-feature=""><i-->
                                                                    <!--                class="fa fa-minus-circle"></i>-->
                                                                    <!--    </button>-->
                                                                    <!--</td>-->
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                            <!--<tfoot>-->
                                                            <!--<tr>-->
                                                            <!--    <th></th>-->
                                                            <!--    <th></th>-->
                                                            <!--    <th>-->
                                                            <!--        <button class="btn btn-primary btn-sm btn-add-features">-->
                                                            <!--            Add New-->
                                                            <!--        </button>-->
                                                            <!--    </th>-->
                                                            <!--</tr>-->
                                                            <!--</tfoot>-->
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">
                                                            Save Changes
                                                        </button>
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $(".search").keyup(function () {
                var searchTerm = $(".search").val();
                var listItem = $('.results tbody').children('tr');
                var searchSplit = searchTerm.replace(/ /g, "'):containsi('");

                $.extend($.expr[':'], {
                    'containsi': function (elem, i, match, array) {
                        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                    }
                });

                $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function (e) {
                    $(this).attr('visible', 'false');
                });

                $(".results tbody tr:containsi('" + searchSplit + "')").each(function (e) {
                    $(this).attr('visible', 'true');
                });

                var jobCount = $('.results tbody tr[visible="true"]').length;
                $('.counter').text(jobCount + ' item');

                if (jobCount == '0') {
                    $('.no-result').show();
                } else {
                    $('.no-result').hide();
                }
            });
        });
    </script>
    <script>

        function generateRandomInteger() {
            return Math.floor(Math.random() * 90000) + 10000;
        }

        jQuery(document).on('click', '.btn-delete-features', function (e) {
            e.preventDefault();
            var $this = $(this);
            $this.closest("tr").remove();
        });

        jQuery(document).on('click', '.btn-add-features', function (e) {
            e.preventDefault();
            // console.log('tgd');
            var lastRow = $('table.table-features > tbody > tr').last().attr('data-row');
            var counter = lastRow ? parseInt(lastRow) + 1 : 1;
            var randomInteger = generateRandomInteger();
            var newRow = jQuery('<tr data-row="' + counter + '">' +
                '<td>' + counter + '</td>' +
                '<td>' +
                '<select name="roles[' + randomInteger + ']" class="form-control" required style="height:30px">' +
                '@foreach($roles as $role)' +
                '<option value={{$role->id}}>{{ $role->name }}</option>' +
                '@endforeach' +
                '</select>' +
                '</td>' +
                '<td><button type="button" class="btn btn-danger btn-sm btn-delete-features" data-feature=""><i class="fa fa-minus-circle"></i></button></td>' +
                '</tr>');
            jQuery('table.table-features').append(newRow);
        });


        $('.js-example-basic-multiple').select2();


    </script>

@endsection