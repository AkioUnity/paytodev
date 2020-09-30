<template>
    <div>
        <div class="amt-section-select">
            <input type="text" name="meta_title" class="form-control" :placeholder="trans('lang.meta_title')" v-model="form.meta_title">
        </div>
        <div class="amt-section-select">
            <textarea class="form-control" :placeholder="trans('lang.meta_desc')" v-model="form.seo_desc"></textarea>
        </div>
        <div class="amt-section-select">
            <div class="at-profile-setting__upload page_banner dc-settingscontent" id="page_banner_wrapper">
                <page-media
                    :parent_id="'page_banner_wrapper'"
                    :id="'page_banner'"
                    :img_ref="'page_banner'"
                    :name="'page_banner'"
                    :url="baseURL+'/admin/pages/upload-temp-image/page_banner'"
                    :preview_class="'page_banner_preview'"
                    :hidden_input_id="'hidden_input_id_page_banner'"
                    :list_id="'list_id_banner'"
                    :upload_title="'upload image'"
                    :btn_text="'select banner'"
                    :img_label="trans('lang.page_banner')"
                    @addedFile="imageAdded()"
                    @fileRemoved="imageRemoved()"
                >
                </page-media>
                <div class="at-profile-setting__imgs">
                    <ul class="page_banner_preview">
                        <li id="imageId" v-if="form.page_banner_value">
                            <input id="radio1" type="radio" name="radio">
                            <label for="radio1">
                                <span>
                                    <img :src="baseURL+'/uploads/pages/'+pageID+'/'+form.page_banner_value" v-if="pageID">
                                    <img :src="tempUrl+form.page_banner_value" v-else>
                                    <span class="at-trash">
                                        <a href="javascript:void(0);" v-on:click="removeImage()">
                                            <i class="ti-trash"></i>
                                        </a>
                                    </span>
                                    <span class="at-tick">
                                        <span>
                                            <i class="fas fa-check"></i>
                                        </span>
                                    </span>
                                </span>
                            </label>
                            <input type="hidden" :value="form.page_banner_value" name="page_banner" id="hidden">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="amt-section-select" v-if="parentPages.length > 0">
            <span class="wt-select">
                <select class="form-control" v-model="form.parent_id">
                    <option value='' selected>{{ trans('lang.select_parent') }}</option>
                    <option v-for="(page, index) in parentPages" :key="index" :value="page.id"> 
                        {{page.title}} 
                    </option>
                </select>
            </span>
        </div>
        <div class="amt-switches-option">
            <div class="at-account-checkbox">
                <div class="at-on-off">
                    <input type="checkbox" id="show_page_title" v-model="form.meta.title.show">
                    <label for="show_page_title"><i></i></label>
                </div>
                <p>{{ trans('lang.show_page_title') }}</p>
            </div>
        </div>
        <div class="amt-switches-option">
            <div class="at-account-checkbox">
                <div class="at-on-off">
                    <input type="checkbox" id="show_page_banner" v-model="form.show_page_banner">
                    <label for="show_page_banner"><i></i></label>
                </div>
                <p>{{ trans('lang.show_page_banner') }}</p>
            </div>
        </div>
        <div class="amt-switches-option">
            <div class="at-account-checkbox">
                <div class="at-on-off">
                    <input type="checkbox" id="show_page" v-model="form.show_page">
                    <label for="show_page"><i></i></label>
                </div>
                <p>{{ trans('lang.add_menu_to_navbar') }}</p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['form','pageID', 'parentPages', 'has_child'],
    data() {
        return {
            baseURL: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
        }
    },
    methods:{
        imageAdded: function() {
            var self = this
            setTimeout(function(){ 
               if (document.querySelector('#page_banner_wrapper .at-profile-setting__imgs ul li input[type=hidden]')) {
                    var hidddenIcon = document.querySelector('#page_banner_wrapper .at-profile-setting__imgs ul li input[type=hidden]');
                    let image = document.getElementById(hidddenIcon.id).value
                    self.form.page_banner_value = image
                } else {
                    self.form.page_banner_value = null
                }
            }, 50);
            setTimeout(function(){ 
                if (document.getElementById('imageId')) {
                    document.getElementById('imageId').remove()
                }
            }, 60);
        },
        removeImage: function() {
            this.form.page_banner_value = null
            document.getElementById('imageId').remove()
        },
        imageRemoved: function() {
            if (this.form.page_banner_value) {
                this.form.page_banner_value = null
            }
        },
    }
}
</script>