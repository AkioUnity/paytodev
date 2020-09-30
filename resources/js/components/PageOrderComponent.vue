<template>
    <div>
        <div class="wt-formtheme wt-skillsform wt-pageorder">
            <transition name="fade">
                <div v-if="isShow" class="sj-jump-messeges">{{ trans('lang.no_record') }}</div>
            </transition>
            <fieldset>
                <div class="form-group">
                    <div class="form-group-holder">
                        <span class="wt-select">
                            <select id="pages_select">
                                <option v-for="(page, index) in pages_list" :key="index" :value="page.id">
                                    {{page.title}}
                                </option>
                                <option v-if="pagesLength==0" selected>
                                    {{trans('lang.no_pages_avail')}}
                                </option>
                            </select>
                        </span>
                        <input type="number" class="form-control" min="0" :placeholder="trans('lang.page_order')" id="page_order_value">
                    </div>
                </div>
                <div class="form-group wt-btnarea">
                    <a href="javascript:void(0);" v-if="pagesLength > 0" class="wt-btn" @click="addPageOrder">{{trans('lang.add_order')}}</a>
                </div>
            </fieldset>
        </div>
        <div class="wt-myskills">
            <ul id="skill_list" class="sortable list">
                <li v-for="(stored_page, index) in storedPages" :key="index" v-if="storedPages" class="skill-element" :ref="'skill-'+index">
                    <div class="wt-dragdroptool">
                        <a href="javascript:void(0)" class="lnr lnr-menu"></a>
                    </div>
                    <span class="skill-dynamic-html">
                        {{stored_page.title}} (<em class="skill-val">{{stored_page.order}}</em>)</span>
                    <span class="skill-dynamic-field sss">
                        <input type="hidden" v-bind:name="'menu[pages]['+index+'][id]'" :value="stored_page.id">
                        <input type="hidden" v-bind:name="'menu[pages]['+index+'][title]'" :value="stored_page.title">
                        <input type="hidden" v-bind:name="'menu[pages]['+index+'][type]'" :value="stored_page.type">
                        <input type="text" v-bind:name="'menu[pages]['+index+'][order]'" :value="stored_page.order">
                    </span>
                    <div class="wt-rightarea">
                        <a href="javascript:void(0);" class="wt-addinfo" @click="editInput(index)"><i class="lnr lnr-pencil"></i></a>
                        <a href="javascript:void(0);" class="wt-deleteinfo delete-skill" @click="removeStoredPage(index)"><i class="lnr lnr-trash"></i></a>
                    </div>
                </li>
                <li v-for="(pageItem, index) in pages" :key="index+page.count">
                    <div class="wt-dragdroptool">
                        <a href="javascript:void(0)" class="lnr lnr-menu"></a>
                    </div>
                    <span class="skill-dynamic-html">{{pageItem.title}} (<em class="skill-val">{{pageItem.order}}</em>)</span>
                    <span class="skill-dynamic-field">
                        <input type="hidden" v-bind:name="'menu[pages]['+[pageItem.count]+'][id]'" :value="pageItem.id">
                        <input type="hidden" v-bind:name="'menu[pages]['+[pageItem.count]+'][title]'" :value="pageItem.title">
                        <input type="hidden" v-bind:name="'menu[pages]['+[pageItem.count]+'][type]'" :value="pageItem.type">
                        <input type="text" v-bind:name="'menu[pages]['+[pageItem.count]+'][order]'" :value="pageItem.order">
                    </span>
                    <div class="wt-rightarea">
                        <a href="javascript:void(0);" class="wt-addinfo"><i class="lnr lnr-pencil"></i></a>
                        <a href="javascript:void(0);" class="wt-deleteinfo" @click="removeOrder(index)"><i class="lnr lnr-trash"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
<script>
 export default{
    props: ['widget_title', 'ph_rate_skills'],
        data(){
            return {
                isShow: false,
                pagesLength:'',
                pageOrdersList: [],
                pages_list:[],
                selected_page: '',
                selected_page_order:'',
                selected_page_text:'',
                edit_class: false,
                edit_skill: '',
                page: {
                    id: '',
                    order: '',
                    title:'',
                    type:'',
                    count: 0
                },
                pages: [],
                storedPages: [],
                counts:0,
                notificationSystem: {
                    error: {
                        position: "topRight",
                        timeout: 4000
                    }
                },
            }
        },
        methods: {
            showError(error){
                return this.$toast.error(' ', error, this.notificationSystem.error);
            },
            getPages(){
                let self = this;
                axios.get(APP_URL + '/get-pages-list')
                .then(function (response) {
                    self.pages_list = response.data.pages;
                    self.pagesLength = self.pages_list.length
                });
            },
            getSavedPages(){
                let self = this;
                axios.get(APP_URL + '/get-saved-pages-order')
                .then(function (response) {
                    self.storedPages = response.data.storedPages;
                    if (self.storedPages) {
                        self.storedPages.forEach(element => {
                            self.pageOrdersList.push(element.order)
                        })
                        let filterPages = self.pages_list.filter(function (cv) {
                            return !self.storedPages.find(function (e) {
                                return e.id == cv.id
                            })
                        })
                        self.pages_list = filterPages
                        self.pagesLength = self.pages_list.length
                    }
                });
            },
            addPageOrder: function () {
                var pageSelect = document.getElementById("pages_select");
                var pageOrderSelect = document.getElementById("page_order_value");
                if (pageSelect.value === "" || pageOrderSelect.value === "") {
                    this.showError('empty field not allow');
                } else {
                    if (this.pageOrdersList.includes(pageOrderSelect.value)) {
                        this.showError('Page order cannot be same');
                        return false;
                    } else {
                        this.pageOrdersList.push(pageOrderSelect.value)
                    }
                    var page_list_count = jQuery('.wt-btn').parents('.wt-skillsform').next('.wt-myskills').find('ul#skill_list li').length;
                    page_list_count = page_list_count - 1;
                    this.page.count = page_list_count;
                    
                    if(pageSelect.options[pageSelect.selectedIndex]) {
                        if (isNaN(pageSelect.options[pageSelect.selectedIndex].value)) {
                            this.page.type = 'innerPages' 
                        } else {
                            this.page.type = 'pages' 
                        }
                        this.selected_page_text = pageSelect.options[pageSelect.selectedIndex].text;
                        this.selected_page = document.getElementById("pages_select").value;
                        this.selected_page_order = document.getElementById("page_order_value").value;
                        this.pages.push(Vue.util.extend({}, this.page, this.page.count++, this.page.title = this.selected_page_text, this.page.id = this.selected_page, this.page.order = this.selected_page_order ))
                        pageSelect.remove(pageSelect.selectedIndex);
                        this.pagesLength--
                        document.getElementById("page_order_value").value = '';
                    } else {
                        this.isShow = true;
                        var self = this;
                        setTimeout(function () {
                            self.isShow = false;
                        }, 3000);
                        
                    }
                }
            },
            removeOrder: function (index) {
                var self = this;
                this.$swal({
                    title: "Delete Order",
                    text: "Are you Sure?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                  }).then((result) => {
                    var self = this;
                    if(result.value) {
                        let option = self.pages[index];
                        var select = document.getElementById("pages_select");
                        select.options[select.options.length] = new Option(option.title, option.id, false, false);
                        self.pages.splice(index, 1);
                        self.$swal('Deleted', 'Page Order Deleted', 'success')
                        self.pagesLength++
                    } else {
                        this.$swal.close()
                    }
                  })
            },
            removeStoredPage: function (index) {
                var self = this;
                this.$swal({
                    title: "Delete Order",
                    text: "Are you Sure?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                  }).then((result) => {
                    var self = this;
                    if(result.value) {
                        let option = self.storedPages[index];
                        var select = document.getElementById("pages_select");
                        select.options[select.options.length] = new Option(option.title, option.id, false, false);
                        self.storedPages.splice(index, 1);
                        self.$swal('Deleted', 'Page Order Deleted', 'success')
                        self.pagesLength++
                    } else {
                        this.$swal.close()
                    }
                  })
            },
            editInput: function (index) {
                this.edit_class = true;
            }
        },
        mounted: function () {
            jQuery(document).on('click', '.wt-addinfo', function (e) {
                e.preventDefault();
                var _this = jQuery(this);
                _this.addClass('wt-skillsactive');
                _this.parents('li').addClass('wt-skillsaddinfo');
            });
            jQuery(document).on('click', '.wt-skillsactive', function (e) {
                e.preventDefault();
                var _this = jQuery(this);
                _this.removeClass('wt-skillsactive');
                _this.parents('li').removeClass('wt-skillsaddinfo');
                var edit_skill_value = _this.parents('li').find('.skill-dynamic-field input:text').val();
                _this.parents('li').find('.skill-dynamic-html em').html(edit_skill_value);
            });
        },
        created: function() {
            this.getPages();
            this.getSavedPages();
        } 
    }
</script>