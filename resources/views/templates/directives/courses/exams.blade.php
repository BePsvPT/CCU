<div>
    <h3>@{{ heading }}</h3>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr class="success">
                <th>課程名稱</th>
                <th>檔案名稱</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="exam in exams">
                <td><a ng-href="#/courses/@{{ exam.course.id }}" data-toggle="tooltip" data-placement="bottom" title="@{{ exam.course.department.name }} - @{{ exam.course.professor }}">@{{ exam.course.name }}</a></td>
                <td>@{{ exam.file_name }}</td>
            </tr>
        </tbody>
    </table>
</div>