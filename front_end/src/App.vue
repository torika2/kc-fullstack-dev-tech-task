<template>

  <div class="row m-0 w-100">
    <div class="col-3 col-md-3 d-flex flex-column">
      <div class="py-2"></div>
      <SideCategoryMenu
          :categories="categories"
          :active-category-id="selected_category?.id"
          @setActiveCategory="setActiveCategory"
      />
    </div>
    <div class="col-9 col-md-9">
      <div>
        <h2><b>{{selected_category.name}}</b></h2>
      </div>
      <CourseCatalog
          :courses="courses"
          :selected_category="selected_category"
      />
    </div>
  </div>
</template>

<script>
import axios from "axios"
import CourseCatalog from "@/components/CourseCatalog.vue"
import SideCategoryMenu from "@/components/SideCategoryMenu.vue"

export default {
  name: 'App',
  components: {
    SideCategoryMenu,
    CourseCatalog,
  },
  data(){
    return {
      categories : [],
      courses : [],
      selected_category : {
        id : null,
        name : 'Course catalog'
      },
    }
  },
  created () {
    this.getCourses()
    this.getCategories()
  },
  methods : {
    setActiveCategory(category){
      console.log(category)
      this.selected_category = category
    },
    async getCourses(){
      axios.get('/api/courses')
        .then((response)=>{
          this.courses = response.data
        })
    },
    async getCategories(){
      axios.get('/api/categories')
        .then((response)=>{
          this.categories = response.data
        })
    },
  },
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
