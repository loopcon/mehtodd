   <style>
       .lesson-videos-container {
           height: 54vh;
           overflow-y: auto;
       }

       .search-container {
           display: flex;
           align-items: center;
           background-color: #fff;
           border-radius: 25px;
           box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
           overflow: hidden;
       }

       .search-input {
           border: none;
           padding: 10px 20px;
           outline: none;
           width: 300px;
           font-size: 16px;
           border-top-left-radius: 25px;
           border-bottom-left-radius: 25px;
       }
   </style>
   <div class="row mb-3">
       <div class="col-md-12 mb-3">
           {!! Form::label('lessonTitle', 'Lesson Title') !!}
           <span class="required">*</span>
           {!! Form::text('name', null, [
               'placeholder' => 'Enter Lesson Title',
               'class' => 'form-control mb-2',
               // 'required' => true,
               'id' => 'lessonTitle',
           ]) !!}
           <span class="input-error text-danger font-required" role="alert">
               <normal lesson-add-form-data-input-error="name"></normal>
           </span>
       </div>
       <div class="row mb-3">
           <div class="col-md-6 mb-2">
               <div class="form-check form-switch addform-lesson">
                   {!! Form::checkbox('is_private', null, null, ['id' => 'isPrivate', 'class' => 'form-check-input']) !!}
                   {!! Form::label('isPrivate', 'Is Lesson Private ?') !!}
               </div>
           </div>

           <div
               class="col-md-6 {{ $action == 'edit' ? ($lesson->is_private == '0' ? 'd-none' : '') : 'd-none' }} lesson-users-private">
               {!! Form::label('users', 'Users') !!}
               <span class="required">*</span>
               <div class="category-selectbox">
                   <div class="editvideo-cat category-border-show">
                       <a href="javascript:void(0);" class="editvideo-cat-click" name="users[]"
                           id="lbl_lesson_users_list">
                           @if (!empty($selectedUsers))
                               {{ implode(', ', array_intersect_key($users, array_flip($selectedUsers))) }}
                           @else
                               Select User
                           @endif
                           <span id="category-main-1"><i class="fa-solid fa-chevron-down"></i></span>
                       </a>
                       <ul class="category-show drp_lesson_users_list add-lesson-category">

                           <div class="form-check search-container">
                               <input type="search" placeholder="Search..." id="user-search-input"
                                   oninput="filterUsers()" class="search-input">
                           </div>

                           @foreach ($users as $id => $privateuser)
                               <li>
                                   <a href="javascript:void(0);" class="subcat-click-category">
                                       <div class="form-check">
                                           {!! Form::checkbox('users[]', $id, isset($selectedUsers) && in_array($id, $selectedUsers), [
                                               'class' => 'form-check-input',
                                               'id' => 'private-user-' . $id,
                                           ]) !!}
                                           {!! Form::label('private-user-' . $id, $privateuser, ['class' => 'form-check-label']) !!}
                                       </div>
                                   </a>
                               </li>
                           @endforeach
                       </ul>
                   </div>
                   <span class="input-error text-danger font-required" role="alert">
                       <normal lesson-add-form-data-input-error="users"></normal>
                   </span>
               </div>
           </div>

       </div>
       <hr>
       <div class="lesson-videos-container row m-0">
           @forelse ($videos as $key => $value)
               @if ($value->is_private == 1 && !$value->userVideoShowOrNot())
                   @continue
               @endif

               <div class="videotag-play col-md-6 ">

                   <video id="video-custom-professional-like-{{ $value->id }}"
                       @if ($value->thumbnail != null) poster="{{ asset('uploads/thumbnail/' . $value->thumbnail) }} @endif">
                       <source src="{{ asset('uploads/videos/' . $value->video) }}" type="video/mp4">
                       Your browser does not support the video tag.
                   </video>

                   <div class="video-titile-group">
                       <div class="play-bt" data-id="{{ $value->id }}">
                           <i class="fa-solid fa-play"></i>
                       </div>
                       <div class="pause-bt" style="display:none;">
                           <i class="fa-solid fa-pause"></i>
                       </div>
                       <p class="docpro-therapy-title">{{ $value->title }}</p>
                       <p class="docpro-therapy-title">
                       <div class="form-check form-switch docpro-addform-lesson">
                           {!! Form::checkbox('video_id[]', $value->id, in_array($value->id, $videoIds ?? []), [
                               'class' => 'form-check-input',
                           ]) !!}
                       </div>
                       </p>
                       <p class="docpro-therapy-name">
                           @if (isset($value->user->displayname) && $value->user->displayname !== null)
                               {{ $value->user->displayname }}
                           @else
                               &nbsp;
                           @endif
                       </p>
                   </div>
               </div>
           @empty
               <div class="no-videos">
                   <h5>No Videos Available.</h5>
               </div>
           @endforelse
       </div>
   </div>
   <div style="text-align: center;">
       {!! link_to('#', 'Load more', [
           'class' => 'mb-4',
           'id' => 'lessonVideoLoadMoreBtn',
           'data-id' => isset($lesson) ? $lesson->id : null,
       ]) !!}
   </div>
