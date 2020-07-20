<div class="wp-comment-form comment-form">

<?php $fields = array(

    //name field
    'author' =>
    '<p class="comment-form-author">
        <label for="author">' . __('Name','zen-read') . '</label>
        <span class="required"></span>
        <input id="author" placeholder="' . __('name','zen-read') . '" name="author" type="text" size="30"/>
    </p>',

    //email field
    'email' =>
    '<p class="comment-form-email">
        <label for="email">' . __('E-mail','zen-read') . '</label> <small>' . __('It will not be visible to the public','zen-read') . '</small>
        <span class="required"></span>
        <input id="email"  placeholder="' . __('e-mail','zen-read') . '" name="email" type="text" size="30"/>
    </p>',

    //removed url field
    'url' => '',

);

$args = array('fields'  =>  $fields,
              'label_submit' => __('Send','zen-read'),
              'title_reply' => '',
              'title_reply_to' => __('Reply','zen-read'),
              'comment_notes_before' => '',
              'comment_notes_after' => '',
              'cancel_reply_link' => __('Cancel','zen-read'));
comment_form($args); ?>

</div><!-- .comment-form -->