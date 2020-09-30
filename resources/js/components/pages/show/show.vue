<template>
  <div>
    <div
      v-for="(element, index) in sections"
      :key="'section'+element.id+index"
      :class="'section-main-wrapper'+element.id+index"
    >
      <slider  
        :element_id="element.id"
        :sliders="form.meta.sliders" 
        :page_id="page_id"
        :symbol="symbol"
        v-if="element.section =='slider'">
      </slider>
      <heading
        :element_id="element.id"
        :parent_index="index"
        :heading_section="form.meta.headings"
        @editData="editSection(element)"
        v-if="element.section =='heading'"
      />
      <editor
        :element_id="element.id"
        :parent_index="index"
        :editor_section="form.meta.content"
        @editData="editSection(element)"
        v-else-if="element.section =='content_section'"
      />
      <categories 
        :element_id="element.id"
        :categories="form.meta.cat"
        @editData="editSection(element)"
        :parent_index="index" 
        v-else-if="element.section =='category'">
      </categories>
      <services 
        :element_id="element.id"
        :services="form.meta.services"
        @editData="editSection(element)"
        :parent_index="index" 
        :access_type="access_type" 
        v-else-if="element.section =='service_section'">
      </services>
      <freelancers 
        :element_id="element.id"
        :freelancers="form.meta.freelancers"
        @editData="editSection(element)"
        :parent_index="index" 
        v-else-if="element.section =='freelancer_section'">
      </freelancers>
      <articles 
        :element_id="element.id"
        :articles="form.meta.articles"
        @editData="editSection(element)"
        :parent_index="index" 
        v-else-if="element.section =='article_section'">
      </articles>
      <app 
        :element_id="element.id"
        :apps="form.meta.app_section"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        v-else-if="element.section =='app_section'">
      </app>
      <work-tab 
        :element_id="element.id"
        :work_sec="form.meta.work_tabs"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        v-else-if="element.section =='work_tab_section'">
      </work-tab>
      <work-video 
        :element_id="element.id"
        :work_sec="form.meta.work_videos"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        v-else-if="element.section =='work_video_section'">
      </work-video>
      <welcome 
        :element_id="element.id"
        :welcome_section="form.meta.welcome_sections"
        @editData="editSection(element)"
        :parent_index="index"
        :pageID="page_id" 
        v-else-if="element.section =='welcome_section'">
      </welcome>
      <categories-v2
        :element_id="element.id"
        :categories="form.meta.categoriesSecondVersion"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        v-else-if="element.section =='categoryV2'">
      </categories-v2>
      <categories-v3
        :element_id="element.id"
        :categories="form.meta.categoriesThirdVersion"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        v-else-if="element.section =='categoryV3'">
      </categories-v3>
      <freelancers-v2 
        :element_id="element.id"
        :freelancers="form.meta.freelancersSecondVersion"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        v-else-if="element.section =='freelancer_section_v2'">
      </freelancers-v2>
      <jobs 
        :element_id="element.id"
        :jobs="form.meta.jobs"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        v-else-if="element.section =='jobs_section'">
      </jobs>
      <packages 
        :element_id="element.id"
        :packages="form.meta.packages"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        :role="auth_role"
        v-else-if="element.section =='package_section'">
      </packages>
      <banner-v1
        :element_id="element.id"
        :banner_sec="form.meta.bannerFirstVersion"
        @editData="editSection(element)"
        :parent_index="index"
        :pageID="page_id" 
        v-else-if="element.section =='bannerV1'">
      </banner-v1>
    </div>
  </div>
</template>
<script>
import slider from './sections/sliders/index'
import heading from './sections/heading'
import editor from './sections/editor'
import categories from './sections/categories'
import services from './sections/services'
import freelancers from './sections/freelancers'
import articles from './sections/articles'
import app from './sections/app/index'
import workTab from './sections/work_tab'
import workVideo from './sections/work_video'
import welcome from './sections/welcome'
import categoriesV2 from './sections/categoriesV2'
import categoriesV3 from './sections/categoriesV3'
import freelancersV2 from './sections/freelancersV2'
import jobs from './sections/jobs'
import packages from './sections/packages'
import bannerV1 from './sections/bannerV1'

export default {
  props:['page_id', 'access_type', 'auth_role', 'symbol'],
  components: {
    slider,
    heading,
    editor,
    categories,
    services,
    freelancers,
    articles,
    app,
    workTab,
    workVideo,
    welcome,
    categoriesV2,
    categoriesV3,
    freelancersV2,
    jobs,
    packages,
    bannerV1
  },
  data () {
    return {
      form: {
        meta_title: '',
        show_page_banner: true,
        show_page_title: false,
        show_page: false,
        page_banner_value:'',
        seo_desc:'',
        parent_id: null,
        slug: '',
        id: '',
        title: '',
        sections: [],
        meta: {
          sliders: [],
          headings: [],
          content: [],
          cat:[],
          services:[],
          freelancers:[],
          app_section:[],
          work_tabs:[],
          work_videos:[],
          welcome_sections:[],
          articles:[],
          categoriesSecondVersion:[],
          freelancersSecondVersion:[],
          jobs:[],
          packages:[],
          bannerFirstVersion:[],
          categoriesThirdVersion:[],
          title:{
            show:true
          } 
        }
      },
      service_section_tabs: [],
      howWorkSectionContent: [],
      articles: [],
      currentElementIndex: '',
      currentSection: '',
      sectionSliders:[],
      sections: [],
      // list:JSON.parse(this.section_list),
      // layouts:JSON.parse(this.layout_list),
      baseURL:APP_URL,
      sectionLocations:[],
      searchableRoles:[],
      pageData:[],
      IconPath:APP_URL+'/images/page-builder/',
      cloneElement:false
    }
  },
  created () {
    this.getPageData()
  },
  methods: {
    getPageData: function () {
      let id = this.page_id
      var self = this
      axios
        .get(APP_URL+ '/get-edit-page/' + id)
        .then(function (response) {
          if (response.data.type == 'success') {
            self.pageData = response.data.page
            // console.log(self.pageData);
            self.form.id = self.pageData.id
            self.form.title = self.pageData.title
            self.form.slug = self.pageData.slug
            self.form.parent_id = self.selected_parent
            self.form.seo_desc = self.seo_desc
            self.form.meta_title = self.pageData.meta_title
            self.form.meta.title.show = self.pageData.show_page_title
            self.form.show_page_banner = self.pageData.show_page_banner
            self.form.page_banner_value = self.pageData.banner
            self.form.show_page = self.pageData.show_page_navbar
            self.getSectionData()
          }
        })
        .catch(function (error) { })
    },
    getSectionData: function () {
      let id = this.page_id
      var self = this
      axios
        .get(APP_URL + '/page/get-sections/' + id)
        .then(function (response) {
          if (response.data.type == 'success') {
            self.pageData.sections = response.data.section_data
            // console.log(self.pageData.sections)
            if (self.pageData.section_list) {
              self.sections = self.pageData.section_list
              // console.log(self.sections);
              var sectionArray = Object.keys(self.pageData.sections).map(i => self.pageData.sections[i]);
              // var sectionArray = Object.keys(self.pageData.sections).map(i => self.pageData.sections[i])
              // console.log(sectionArray)
              sectionArray.forEach(element => {
                // console.log(element)
                element = element.filter(function (sec) {
                  // console.log('sec',sec)
                  self.sections.find(function (e) {
                    if (typeof sec != 'string') {
                      if (e.id == sec.id) {
                        self.form.meta[e.value].push(sec)
                        // console.log(self.form.meta)
                      }
                    }
                  })
                })
              })
            }
          }
        })
        .catch(function (error) { })
    },
  }
}
</script>
