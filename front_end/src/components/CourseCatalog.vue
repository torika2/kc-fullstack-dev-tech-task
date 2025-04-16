
<template>
  <div>
    <div class="row m-0">
      <div
          class="col-md-12 col-lg-4 mt-4"
          v-for="course in data"
          :key="course.course_id"
          v-show="!course.is_active"
      >
        <div class="card w-100 h-100 position-relative shadow-sm">
          <img
              :src="course.image_preview"
              alt="Image"
              class="rounded rounded-bottom-0"
          >
          <div class="p-3">
            <h4 class="text-start" v-text="course.title.slice(0, 26)+'...'"></h4>
            <h6 class="text-start" v-text="course.description.slice(0, 90)+'...'"></h6>
          </div>
          <div class="position-absolute end-0 py-1 px-2 shadow me-1 mt-1 bg-white rounded" v-text="course.main_category"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ['courses', 'selected_category'],
  computed : {
    data(){
      let category = this.selected_category
      return this.courses.map((course)=>{
        if(category.id){
          course.is_active = category.id !== course.category_id
        }else{
          course.is_active = false
        }
        return course
      })
    },
  },
  methods : {
    resetCourseActive(){
      this.data.map((course)=>{
        course.is_active = false
      })
    },
  }
}
</script>
