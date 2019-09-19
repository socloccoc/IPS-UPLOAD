@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('errors.errorlist')
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                    <tr>
                        {{--<th>Country</th>--}}
                        <th>Locale</th>
                        <th>Number Of Ip</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($ips as $ip)
                        <tr>
                            {{--<td>{{ isset($ip->country) ? $ip->country : '' }}</td>--}}
                            <td>{{ isset($ip->locale) ? $ip->locale : '' }}</td>
                            <td>{{ isset($ip->total) ? $ip->total : '' }}</td>
                            <td>
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')"
                                   class="btn btn-danger btn-lg"
                                   href="{{ route('ip.deleteIpByLocale', ['locale'=> $ip->locale]) }}">
                                    <span class="glyphicon glyphicon-trash"></span> Remove
                                </a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        {{--<th>Country</th>--}}
                        <th>Locale</th>
                        <th>Number Of Ip</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                responsive: true
            });
            new $.fn.dataTable.FixedHeader(table);
        });
    </script>
@endsection