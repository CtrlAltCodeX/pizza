@extends("web.layout.master")

@push('css')
<style id='wpml-legacy-horizontal-list-0-inline-css' type='text/css'>
    body {
        padding: 0px !important;
    }

    .order-call-nav {
        display: flex;
    }

    .container {
        padding: 0px !important;
    }

    .wpml-ls-statics-shortcode_actions {
        background-color: #ffffff;
    }

    .wpml-ls-statics-shortcode_actions,
    .wpml-ls-statics-shortcode_actions .wpml-ls-sub-menu,
    .wpml-ls-statics-shortcode_actions a {
        border-color: #cdcdcd;
    }

    .wpml-ls-statics-shortcode_actions a,
    .wpml-ls-statics-shortcode_actions .wpml-ls-sub-menu a,
    .wpml-ls-statics-shortcode_actions .wpml-ls-sub-menu a:link,
    .wpml-ls-statics-shortcode_actions li:not(.wpml-ls-current-language) .wpml-ls-link,
    .wpml-ls-statics-shortcode_actions li:not(.wpml-ls-current-language) .wpml-ls-link:link {
        color: #444444;
        background-color: #ffffff;
    }

    .wpml-ls-statics-shortcode_actions a,
    .wpml-ls-statics-shortcode_actions .wpml-ls-sub-menu a:hover,
    .wpml-ls-statics-shortcode_actions .wpml-ls-sub-menu a:focus,
    .wpml-ls-statics-shortcode_actions .wpml-ls-sub-menu a:link:hover,
    .wpml-ls-statics-shortcode_actions .wpml-ls-sub-menu a:link:focus {
        color: #000000;
        background-color: #eeeeee;
    }

    .wpml-ls-statics-shortcode_actions .wpml-ls-current-language>a {
        color: #444444;
        background-color: #ffffff;
    }

    .wpml-ls-statics-shortcode_actions .wpml-ls-current-language:hover>a,
    .wpml-ls-statics-shortcode_actions .wpml-ls-current-language>a:focus {
        color: #000000;
        background-color: #eeeeee;
    }
</style>
@endpush

@section("section")

<main role="main" id="main">
    <div class="wrapper">
        <div class="grid d-flex">
            <div class="grid__item lap-2-3">
                <article id="post-39" class="article post-39 page type-page status-publish hentry">
                    <h1 class="pagetitle">Contact</h1>
                    <div class="article__body">
                        <div class='gf_browser_chrome gform_wrapper gform_legacy_markup_wrapper gform-theme--no-framework' data-form-theme='legacy' data-form-index='0' id='gform_wrapper_3'>
                            <form method='post' enctype='multipart/form-data' id='gform_3' action='/contact/' data-formid='3' novalidate>
                                <div class='gform-body gform_body'>
                                    <ul id='gform_fields_3' class='gform_fields top_label form_sublabel_below description_below'>
                                        <li id="field_3_1" class="gfield gfield--type-text gfield_contains_required field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible" data-js-reload="field_3_1"><label class='gfield_label gform-field-label' for='input_3_1'>Name<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
                                            <div class='ginput_container ginput_container_text'><input name='input_1' id='input_3_1' type='text' value='' class='medium' aria-required="true" aria-invalid="false" /> </div>
                                        </li>
                                        <li id="field_3_2" class="gfield gfield--type-email gfield_contains_required field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible" data-js-reload="field_3_2"><label class='gfield_label gform-field-label' for='input_3_2'>Email<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
                                            <div class='ginput_container ginput_container_email'>
                                                <input name='input_2' id='input_3_2' type='email' value='' class='medium' aria-required="true" aria-invalid="false" />
                                            </div>
                                        </li>
                                        <li id="field_3_3" class="gfield gfield--type-phone field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible" data-js-reload="field_3_3"><label class='gfield_label gform-field-label' for='input_3_3'>Phone</label>
                                            <div class='ginput_container ginput_container_phone'><input name='input_3' id='input_3_3' type='tel' value='' class='medium' aria-invalid="false" /></div>
                                        </li>
                                        <li id="field_3_4" class="gfield gfield--type-text field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible" data-js-reload="field_3_4"><label class='gfield_label gform-field-label' for='input_3_4'>Location</label>
                                            <div class='ginput_container ginput_container_text'><input name='input_4' id='input_3_4' type='text' value='' class='medium' aria-invalid="false" /> </div>
                                        </li>
                                        <li id="field_3_5" class="gfield gfield--type-text field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible" data-js-reload="field_3_5"><label class='gfield_label gform-field-label' for='input_3_5'>Postal Code</label>
                                            <div class='ginput_container ginput_container_text'><input name='input_5' id='input_3_5' type='text' value='' class='medium' aria-invalid="false" /> </div>
                                        </li>
                                        <li id="field_3_6" class="gfield gfield--type-text field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible" data-js-reload="field_3_6"><label class='gfield_label gform-field-label' for='input_3_6'>Order #</label>
                                            <div class='ginput_container ginput_container_text'><input name='input_6' id='input_3_6' type='text' value='' class='medium' aria-invalid="false" /> </div>
                                        </li>
                                        <li id="field_3_7" class="gfield gfield--type-textarea field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible" data-js-reload="field_3_7"><label class='gfield_label gform-field-label' for='input_3_7'>Comments</label>
                                            <div class='ginput_container ginput_container_textarea'><textarea name='input_7' id='input_3_7' class='textarea medium' aria-invalid="false" rows='10' cols='50'></textarea></div>
                                        </li>
                                        <li id="field_3_8" class="gfield gfield--type-captcha field_sublabel_below gfield--no-description field_description_below hidden_label gfield_visibility_visible" data-js-reload="field_3_8"><label class='gfield_label gform-field-label screen-reader-text' for='input_3_8'></label>
                                            <div id='input_3_8' class='ginput_container ginput_recaptcha' data-sitekey='6LeErMcZAAAAAJnJLb6mjrwrCleo6U4Y_0jYpOLi' data-theme='light' data-tabindex='0' data-badge=''></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class='gform_footer top_label'>
                                    <p><button class='btn btn--primary' id='gform_submit_button_3'>Submit</button></p>
                                    <input type='hidden' class='gform_hidden' name='is_submit_3' value='1' />
                                    <input type='hidden' class='gform_hidden' name='gform_submit' value='3' />

                                    <input type='hidden' class='gform_hidden' name='gform_unique_id' value='' />
                                    <input type='hidden' class='gform_hidden' name='state_3' value='WyJbXSIsImYzYmFkNTVlZTFhOWIxYjZjMmZmYWVlMTkzZjUyNmU0Il0=' />
                                    <input type='hidden' class='gform_hidden' name='gform_target_page_number_3' id='gform_target_page_number_3' value='0' />
                                    <input type='hidden' class='gform_hidden' name='gform_source_page_number_3' id='gform_source_page_number_3' value='1' />
                                    <input type='hidden' name='gform_field_values' value='' />

                                </div>
                            </form>
                        </div>
                        <script type="text/javascript">
                            gform.initializeOnLoaded(function() {
                                gformInitSpinner(3, 'https://gabrielpizza.com/wp-content/plugins/gravityforms/images/spinner.svg', true);
                                jQuery('#gform_ajax_frame_3').on('load', function() {
                                    var contents = jQuery(this).contents().find('*').html();
                                    var is_postback = contents.indexOf('GF_AJAX_POSTBACK') >= 0;
                                    if (!is_postback) {
                                        return;
                                    }
                                    var form_content = jQuery(this).contents().find('#gform_wrapper_3');
                                    var is_confirmation = jQuery(this).contents().find('#gform_confirmation_wrapper_3').length > 0;
                                    var is_redirect = contents.indexOf('gformRedirect(){') >= 0;
                                    var is_form = form_content.length > 0 && !is_redirect && !is_confirmation;
                                    var mt = parseInt(jQuery('html').css('margin-top'), 10) + parseInt(jQuery('body').css('margin-top'), 10) + 100;
                                    if (is_form) {
                                        jQuery('#gform_wrapper_3').html(form_content.html());
                                        if (form_content.hasClass('gform_validation_error')) {
                                            jQuery('#gform_wrapper_3').addClass('gform_validation_error');
                                        } else {
                                            jQuery('#gform_wrapper_3').removeClass('gform_validation_error');
                                        }
                                        setTimeout(function() {
                                            /* delay the scroll by 50 milliseconds to fix a bug in chrome */
                                        }, 50);
                                        if (window['gformInitDatepicker']) {
                                            gformInitDatepicker();
                                        }
                                        if (window['gformInitPriceFields']) {
                                            gformInitPriceFields();
                                        }
                                        var current_page = jQuery('#gform_source_page_number_3').val();
                                        gformInitSpinner(3, 'https://gabrielpizza.com/wp-content/plugins/gravityforms/images/spinner.svg', true);
                                        jQuery(document).trigger('gform_page_loaded', [3, current_page]);
                                        window['gf_submitting_3'] = false;
                                    } else if (!is_redirect) {
                                        var confirmation_content = jQuery(this).contents().find('.GF_AJAX_POSTBACK').html();
                                        if (!confirmation_content) {
                                            confirmation_content = contents;
                                        }
                                        setTimeout(function() {
                                            jQuery('#gform_wrapper_3').replaceWith(confirmation_content);
                                            jQuery(document).trigger('gform_confirmation_loaded', [3]);
                                            window['gf_submitting_3'] = false;
                                            wp.a11y.speak(jQuery('#gform_confirmation_message_3').text());
                                        }, 50);
                                    } else {
                                        jQuery('#gform_3').append(contents);
                                        if (window['gformRedirect']) {
                                            gformRedirect();
                                        }
                                    }
                                    jQuery(document).trigger('gform_post_render', [3, current_page]);
                                    gform.utils.trigger({
                                        event: 'gform/postRender',
                                        native: false,
                                        data: {
                                            formId: 3,
                                            currentPage: current_page
                                        }
                                    });
                                });
                            });
                        </script>

                    </div>
                    <div class="article__comments">
                        <div class="comments">
                        </div>
                    </div>
                </article>
            </div>
            <div class="grid__item lap-1-3">
                <div class="sidebar">
                    <aside>
                        <h1>Gabriel Pizza Franchise Corp</h1>
                        <p>200-5335<br />
                            Canotek Rd.<br />
                            Ottawa, Ontario<br />
                            K1J 9L4<br />
                            Phone 613-748-0845<br />
                            Fax 613-744-4930</p>
                        <p>If you are contacting us about an e-gift; email <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="57303e31233436253317303635253e323b273e2d2d367934383a">[email&#160;protected]</a></p>
                    </aside>
                    <aside>
                        <h1>Looking for a restaurant location</h1>
                        <p><a href="https://gabrielpizza.com/locations/" class="btn btn--primary">Find a Location</a></p>
                    </aside>
                    <aside>
                        <h1>Reach us at</h1>
                        <p><strong>Ottawa &#8211; 613 319-7777</strong></p>
                        <p><strong>Kingston &#8211; 343 344-7777</strong></p>
                        <p><strong>Quebec &#8211; 819 881-5555</strong></p>
                        <p><strong>Nova Scotia &#8211; 902 932-2500</strong></p>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@push('js')
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script type='text/javascript' src='https://gabrielpizza.com/wp-content/themes/gabriel-theme/js/dist/scripts.min.js' id='scripts-js'></script>
<script type='text/javascript' src='https://gabrielpizza.com/wp-includes/js/dist/vendor/wp-polyfill-inert.min.js?ver=3.1.2' id='wp-polyfill-inert-js'></script>
<script type='text/javascript' src='https://gabrielpizza.com/wp-includes/js/dist/vendor/regenerator-runtime.min.js?ver=0.13.11' id='regenerator-runtime-js'></script>
<script type='text/javascript' src='https://gabrielpizza.com/wp-includes/js/dist/vendor/wp-polyfill.min.js?ver=3.15.0' id='wp-polyfill-js'></script>
<script type='text/javascript' src='https://gabrielpizza.com/wp-includes/js/dist/dom-ready.min.js?ver=392bdd43726760d1f3ca' id='wp-dom-ready-js'></script>
<script type='text/javascript' src='https://gabrielpizza.com/wp-includes/js/dist/hooks.min.js?ver=4169d3cf8e8d95a3d6d5' id='wp-hooks-js'></script>
<script type='text/javascript' src='https://gabrielpizza.com/wp-includes/js/dist/i18n.min.js?ver=9e794f35a71bb98672ae' id='wp-i18n-js'></script>
<script type='text/javascript' src='https://gabrielpizza.com/wp-includes/js/dist/a11y.min.js?ver=ecce20f002eda4c19664' id='wp-a11y-js'></script>
<script type='text/javascript' defer='defer' src='https://gabrielpizza.com/wp-content/plugins/gravityforms/js/jquery.maskedinput.min.js?ver=2.7.10' id='gform_masked_input-js'></script>
<script type='text/javascript' defer='defer' src='https://gabrielpizza.com/wp-content/plugins/gravityforms/assets/js/dist/vendor-theme.min.js?ver=4ef53fe41c14a48b294541d9fc37387e' id='gform_gravityforms_theme_vendors-js'></script>
<script type='text/javascript' defer='defer' src='https://gabrielpizza.com/wp-content/plugins/gravityforms/assets/js/dist/scripts-theme.min.js?ver=443293948084ca0fe29518ebcd01dc6b' id='gform_gravityforms_theme-js'></script>
@endpush