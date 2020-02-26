<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">数据统计</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                @foreach($headers as $title_key => $title_value)
                    <th>{{ $title_value }}</th>
                @endforeach
                </tr>
                @foreach($list as $key => $item)
                <tr>
                    @foreach($headers as $title_key => $title_value)
                    @if($title_key=='title')
                    <td>{{ $staticTitles[$item[$title_key]] }}</td>
                    @else
                    <td>{{ $item[$title_key] }}</td>
                    @endif
                    @endforeach
                </tr>
                @endforeach
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
</div>