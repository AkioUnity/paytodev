<template>
    <div 
        :class="banner.sectionClass + ' wt-homebannerseven'"
        :id="banner.sectionId" 
        :style="sectionStyle" 
        v-if="Object.entries(banner).length != 0"
    >
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="wt-bannercontent wt-bannercontentseven">
                        <div class="wt-bannerhead">
                            <div class="wt-title">
                                <h1 :style="{color:banner.subtitleColor}"><span :style="{color:banner.titleColor}" v-if="banner.title">{{ banner.title }}</span> {{ banner.subtitle }}</h1>
                            </div>
                        </div>
                        <search-form
                            :widget_type="'home'"
                            :placeholder="trans('lang.looking_for')"
                            :freelancer_placeholder="trans('lang.search_filter_list.freelancer')"
                            :employer_placeholder="trans('lang.search_filter_list.employers')"
                            :job_placeholder="trans('lang.search_filter_list.jobs')"
                            :service_placeholder="trans('lang.search_filter_list.services')"
                            :no_record_message="trans('lang.no_record')"
                            :style_type="'new'"
                            v-if="banner.showSearchForm"
                            >
                        </search-form>
                        <!-- <form class="wt-formtheme wt-formbanner" v-if="banner.showSearchForm">
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" name="fullname" class="form-control" placeholder="I’m looking for">
                                    <div class="wt-formoptions">
                                        <div class="wt-dropdown">
                                            <span>In: <em class="selected-search-type">Freelancers </em><i class="lnr lnr-chevron-down"></i></span>
                                        </div>
                                        <div class="wt-radioholder">
                                            <span class="wt-radio">
                                                <input id="wt-freelancers" data-title="Freelancers" type="radio" name="searchtype" value="freelancer" checked="">
                                                <label for="wt-freelancers">Freelancers</label>
                                            </span>
                                            <span class="wt-radio">
                                                <input id="wt-jobs" data-title="Jobs" type="radio" name="searchtype" value="job">
                                                <label for="wt-jobs">Jobs</label>
                                            </span>
                                            <span class="wt-radio">
                                                <input id="wt-company" data-title="Companies" type="radio" name="searchtype" value="job">
                                                <label for="wt-company">Companies</label>
                                            </span>
                                        </div>
                                        <a href="userlisting.html" class="wt-searchbtn"><i class="lnr lnr-magnifier"></i> Search</a>
                                    </div>
                                </div>
                            </fieldset>
                        </form> -->
                        <div class="wt-videoholder">
                            <div class="wt-videoshow">
                                <a data-rel="prettyPhoto[video]" :href="banner.videoUrl" rel="prettyPhoto[video]"><i class="fa fa-play"></i></a>
                            </div>
                            <div class="wt-videocontent">
                                <span>{{banner.videoTitle}}<em>{{banner.videoDesc}}</em></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <figure class="wt-homeseven-img">
                        <img 
                            :src="tempUrl+banner.frontImg" 
                            alt="image"
                            v-if="newFrontImage"
                        >
                        <img 
                            :src="imageUrl+banner.frontImg" 
                            alt="img description" 
                            v-else-if="pageID"
                        />
                    </figure>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// import Event from '../../../event'
import carousel from 'vue-owl-carousel'

export default {
    props:['parent_index', 'element_id', 'banner_sec', 'pageID'],
    components:{carousel},
    data() {
        return {
            banner:{},
            topPackages:[],
            package_options:[],
            roleType:false,
            isActive:false,
            baseUrl: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.pageID+'/',
            filtersApplied: false,
            newFrontImage: false,
            newBannerImage: false,
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.banner.padding ? `${this.banner.padding.top}${this.banner.padding.unit} ${this.banner.padding.right}${this.banner.padding.unit} ${this.banner.padding.bottom}${this.banner.padding.unit} ${this.banner.padding.left}${this.banner.padding.unit}` : '',
                margin: this.banner.margin ? `${this.banner.margin.top}${this.banner.margin.unit} ${this.banner.margin.right}${this.banner.margin.unit} ${this.banner.margin.bottom}${this.banner.margin.unit} ${this.banner.margin.left}${this.banner.margin.unit}` : '',
                'text-align': this.banner.alignment,
                background: this.newBannerImage ? 'url('+ this.tempUrl + this.banner.backgroundImg+')' : this.pageID ? 'url('+ this.imageUrl + this.banner.backgroundImg+')' : this.banner.sectionColor
            }
        },
        contentSectionStyle() {
            return {
                background:this.banner.contentBackground,
                color:this.banner.contentColor
            }
        },
    },
    updated: function() {
        var index = this.getArrayIndex(this.banner_sec, 'id', this.element_id)
        if (this.banner[index]) {
            this.banner = this.banner[index]
        }
        this.banner.id = this.element_id
    },
    mounted: function() {
        this.isActive = false
        var self= this
        Event.$on('banner-section-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })
        Event.$on('new-banner-front-image', (data) => {
            this.newFrontImage = true
        })
        Event.$on('new-banner-bg-image', (data) => {
            this.newBannerImage = true
        })
    },
    methods:{
        // getPackages: function() {
        //     var self = this;
        //     let role = ''
        //     if (this.roleType) {
        //         role = 'employer'
        //     } else {
        //         role = 'freelancer'
        //     }
        //     axios
        //     .get(APP_URL + '/get-top-banner_sec/' + role)
        //     .then(function(response) {
        //         if (response.data.type == "success") {
        //             self.topPackages = response.data.banner_sec
        //             self.package_options = response.data.package_options
        //             console.log(self.package_options)
        //             self.filtersApplied = true
        //         }
        //     })
        //     .catch(function(error) {  });
        // }
    },
    created: function() {
        var self = this
        setTimeout(function(){ 
            var index = self.getArrayIndex(self.banner_sec, 'id', self.element_id)
            if (self.banner_sec[index]) {
                self.banner = self.banner_sec[index]
            }
        }, 100);
        // this.getPackages()
    },
};
</script>
