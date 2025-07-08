<?php

/**
 * Comments
 */

 if( post_password_required() ){
    return;
 }

 $comments_args = array(
    'post_id'       => get_the_ID(),
    'order'         => 'ASC',
    'status'        => 'approve',
    'parent'        => 0
 );
 
 $comments = get_comments($comments_args);
?>
<div class="rbt-comment-area">
    <div class="comment-respond">
    <?php
        $user          = wp_get_current_user();
        $user_identity = $user->exists() ? $user->display_name : '';
        $textarea_field = '<div class="col-12">
            <div class="form-group">
                <label for="message">Leave a Reply<span class="required">*</span></label>
                <textarea id="comment-message" name="comment" aria-required="true"></textarea>
            </div>
        </div>';
        $submit_field = '<div class="col-lg-12">
            <button name="%1$s" type="submit" class="rbt-btn btn-gradient icon-hover radius-round btn-md" value="%4$s">
                <span class="btn-text">%4$s</span>
                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
            </button>
        </div>';
        $email_field = '<div class="col-lg-4 col-md-4 col-12">
            <div class="form-group">
                <label for="email">Your Email</label>
                <input id="email" type="email" name="email">
            </div>
        </div>';
        $name_field = '<div class="col-lg-4 col-md-4 col-12">
            <div class="form-group">
                <label for="author">Your Name</label>
                <input id="author" name="author" type="text">
            </div>
        </div>';

        $url_field = '<div class="col-lg-4 col-md-4 col-12">
            <div class="form-group">
                <label for="url">Your Website</label>
                <input id="url" type="text" name="url">
            </div>
        </div>';

        $url_field .= $textarea_field;

        $cookie_field = '<div class="col-lg-12">
            <p class="comment-form-cookies-consent">
                <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent"
                    type="checkbox" value="yes">
                <label for="wp-comment-cookies-consent">Save my name, email, and
                    website in this browser for the next time I comment.</label>
            </p>
        </div>';

        $comments_args = array(
            'fields'            => array(
                'author'        => $name_field,
                'email'         => $email_field,
                'url'           => $url_field,
                'cookies'       => $cookie_field,
            ),
            'logged_in_as'         => sprintf(
                '<p class="comment-notes">%s %s</p>',
                sprintf(
                    /* translators: 1: User name, 2: Edit user link, 3: Logout URL. */
                    __( 'Logged in as %1$s. <a href="%2$s">Edit your profile</a>. <a href="%3$s">Log out?</a>' ),
                    $user_identity,
                    get_edit_user_link(),
                    /** This filter is documented in wp-includes/link-template.php */
                    wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ), get_the_ID() ) )
                ),
                'Required fields are marked <span class="required">*</span>'
            ),
        
            'label_submit'          => wp_kses_post( 'Post Comment' ),
        
            'title_reply'           => wp_kses_post( '<h4 class="title">Post a Comment</h4>'),
        
            'title_reply_to'        => wp_kses_post( 'Reply' ),
            
            'cancel_reply_link'     => wp_kses_post( '<small class="text-danger float-right">Cancel</small>' ),
            
            'comment_field'         => '<div class="row row--10">',
            'class_form'            => 'comment-form',
            'submit_button'         => wp_kses_post( $submit_field ),
            'submit_field'          => '%1$s %2$s</div>'
        );

        if( is_user_logged_in() ){
            $comments_args['comment_field'] .= $textarea_field;
        }
        comment_form($comments_args);
    ?>
    </div>
</div>

<div class="rbt-comment-area">
    <h4 class="title"><?php echo get_comments_number_text(); ?></h4>
    <ul class="comment-list">
        <!-- Start Single Comment  -->
        <?php foreach( $comments as $comment ): ?>
            <?php if( $comment->get_children() ): ?>
            <li class="comment">
                <div class="comment-body">
                    <div class="single-comment">
                        <?php if( get_comment_type($comment) === 'comment' ):?>
                        <div class="comment-img">
                            <?php echo get_avatar(get_comment_author_email($comment)); ?>
                        </div>
                        <?php endif; ?>
                        <div class="comment-inner">
                            <h6 class="commenter">
                                <?php
                                    if(get_comment_author_url( $comment ) != ''){
                                        printf('<a href="%1$s">%2$s</a>', get_comment_author_url( $comment ), esc_html(ucwords(get_comment_author($comment))));
                                    }else{
                                        echo esc_html(get_comment_author($comment)); 
                                    }
                                ?> 
                            </h6>
                            <div class="comment-meta">
                                <div class="time-spent"><?php comment_date('F j, Y h:m a', $comment)?></div>
                                <div class="reply-edit">
                                    <div class="reply">
                                        <?php comment_reply_link( array( 'reply_text' => 'Reply_', 'depth' => 1, 'max_depth' => 2 ), $comment ); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="comment-text">
                                <p class="b2"><?php echo wp_kses_post(get_comment_text($comment)); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php
                $child_comments_args = array(
                    'parent'        => get_comment_ID(),
                    'hierarchical'  => true,
                    'order'         => 'ASC'
                );
                
                $child_comments = get_comments($child_comments_args);
            ?>
            <?php foreach( $child_comments as $child_comment ): ?>
                <ul class="children">
                    <li class="comment">
                        <div class="comment-body">
                            <div class="single-comment">
                                <?php if( get_comment_type($child_comment) === 'comment' ):?>
                                <div class="comment-img">
                                    <?php echo get_avatar(get_comment_author_email($child_comment)); ?>
                                </div>
                                <?php endif; ?>
                                <div class="comment-inner">
                                    <h6 class="commenter">
                                        <?php
                                            if(get_comment_author_url( $child_comment ) != ''){
                                                printf('<a href="%1$s">%2$s</a>', get_comment_author_url( $child_comment ), esc_html(ucwords(get_comment_author($child_comment))));
                                            }else{
                                                echo esc_html(ucwords(get_comment_author($child_comment))); 
                                            }
                                        ?> 
                                    </h6>
                                    <div class="comment-meta">
                                        <div class="time-spent"><?php comment_date('F j, Y h:m a', $child_comment)?></div>
                                        <div class="reply-edit">
                                            <div class="reply">
                                                <?php comment_reply_link( array( 'reply_text' => 'Reply_', 'depth' => 1, 'max_depth' => 2 ), $child_comment ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-text">
                                        <p class="b2"><?php echo wp_kses_post(get_comment_text($child_comment)); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            <?php endforeach; ?>
            <?php else: ?>
            <li class="comment">
                <div class="comment-body">
                    <div class="single-comment">
                        <?php if( get_comment_type($comment) === 'comment' ):?>
                        <div class="comment-img">
                            <?php echo get_avatar(get_comment_author_email($comment)); ?>
                        </div>
                        <?php endif; ?>
                        <div class="comment-inner">
                            <h6 class="commenter">
                                <?php
                                    if(get_comment_author_url( $comment ) != ''){
                                        printf('<a href="%1$s">%2$s</a>', get_comment_author_url( $comment ), esc_html(ucwords(get_comment_author($comment))));
                                    }else{
                                        echo esc_html(get_comment_author($comment)); 
                                    }
                                ?> 
                            </h6>
                            <div class="comment-meta">
                                <div class="time-spent"><?php comment_date('F j, Y h:m a', $comment)?></div>
                                <div class="reply-edit">
                                    <div class="reply">
                                        <?php comment_reply_link( array( 'reply_text' => 'Reply_', 'depth' => 1, 'max_depth' => 2 ), $comment ); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="comment-text">
                                <p class="b2"><?php echo wp_kses_post(get_comment_text($comment)); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>
