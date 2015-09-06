<div>
    <h3><span class="fa fa-info-circle" aria-hidden="true"></span> 課程資訊</h3><br>

    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="row text-center">
                <courses-info icon="fa-university" type="開課系所" value="@{{ info.department.name }}"></courses-info>

                <courses-info icon="fa-file-text" type="課程名稱" value="@{{ info.name }}"></courses-info>

                <courses-info icon="fa-user" type="授課教授" value="@{{ info.professor }}"></courses-info>
            </div>
        </div>
    </div>

    <hr>
</div>

<div ng-controller="CoursesCommentsController">
    <h3><span class="fa fa-comments" aria-hidden="true"></span> 課程評論</h3><br>

    <div class="row">
        <div ng-if="$root.user.signIn" class="col-xs-10 col-xs-offset-1 col-sm-7 col-sm-offset-1">
            <div class="media">
                <div class="media-left">
                    <img class="media-object profile-picture-medium" src="https://ccu.bepsvpt.net/favicon.png" alt="Profile Picture">
                </div>
                <div class="media-body">
                    <form ng-submit="commentForm.$valid && commentFormSubmit()" name="commentForm" method="POST" accept-charset="UTF-8" data-toggle="validator">
                        <fieldset>
                            <div class="form-group">
                                <label class="sr-only">留言</label>
                                <textarea ng-model="comment.content" class="form-control textarea-no-resize" rows="1" placeholder="留言..." data-minlength="10" data-minlength-error="至少需10個字" maxlength="1000" required></textarea>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group text-right">
                                <label>{!! Form::checkbox('anonymous', true, null, ['ng-model' => 'comment.anonymous']) !!} <span>匿名</span></label>

                                {!! Form::submit('送出', ['class' => 'btn btn-sm btn-success']) !!}
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div ng-hide="comments.data.length" class="col-xs-10 col-xs-offset-1 text-center">
            <h3 ng-hide="undefined === comments" class="text-muted">尚無留言</h3>
        </div>
        <div ng-if="comments.data.length" class="col-xs-10 col-xs-offset-1 col-sm-7 col-sm-offset-1">
            <div ng-repeat="comment in comments.data" class="media">
                <div class="media-left media-top">
                    <img class="media-object profile-picture-small" src="https://ccu.bepsvpt.net/favicon.png" alt="Profile Picture">
                </div>
                <div class="media-body courses-comments">
                    <courses-comments-body comment="comment" vote="vote"></courses-comments-body>

                    <hr ng-if="comment.comments.length" class="courses-comments-hr">

                    <div ng-if="comment.comments.length && ( ! comment.sub)" ng-click="comment.sub = true">
                        <small class="text-primary cursor-pointer">檢視回覆</small>
                    </div>

                    <div ng-if="comment.sub" class="courses-comments-comments">
                        <div ng-repeat="subComment in comment.comments" class="media">
                            <div class="media-left">
                                <img class="media-object profile-picture-small" src="https://ccu.bepsvpt.net/favicon.png" alt="Profile Picture">
                            </div>

                            <div class="media-body">
                                <courses-comments-body comment="subComment" vote="vote"></courses-comments-body>
                            </div>
                        </div>
                    </div>

                    <div ng-if="$root.user.signIn" class="media">
                        <div class="media-left">
                            <img class="media-object profile-picture-small" src="https://ccu.bepsvpt.net/favicon.png" alt="Profile Picture">
                        </div>
                        <div class="media-body">
                            <form ng-submit="commentsComment[comment.id].content.length >= 10 && commentFormSubmit(comment.id)" method="POST" accept-charset="UTF-8" data-toggle="validator">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="sr-only">回覆</label>
                                        <textarea ng-model="commentsComment[comment.id].content" class="form-control textarea-no-resize" rows="1" placeholder="回覆..." data-minlength="10" data-minlength-error="至少需10個字" maxlength="1000" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group text-right">
                                        <label>{!! Form::checkbox('anonymous', true, null, ['ng-model' => 'commentsComment[comment.id].anonymous']) !!} <span>匿名</span></label>

                                        {!! Form::submit('送出', ['class' => 'btn btn-xs btn-success']) !!}
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <ul class="pager">
                    <li ng-class="(comments.prev_page_url) ? '' : 'disabled'" class="previous cursor-pointer"><span ng-click="commentsPaginate(false, comments.prev_page_url)" class="text-primary">← Newer</span></li>
                    <li ng-class="(comments.next_page_url) ? '' : 'disabled'" class="next cursor-pointer"><span ng-click="commentsPaginate(true, comments.next_page_url)" class="text-primary">Older →</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>