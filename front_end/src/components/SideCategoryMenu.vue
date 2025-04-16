<template>
  <div class="px-0 px-sm-2 px-md-4 mt-4">
    <div v-for="category in data" :key="category.id" class="mt-2">
      <div
        @click="resetActiveCategories(category.children[0]);category.children[0].is_active = true"
        class="text-start category-text"
        v-text="category.name"
      ></div>
      <div
          @click="resetActiveCategories(subcategory); subcategory.is_active = true"
          class="text-start ps-4 mt-1 category-text subcategory"
          :class="{
            'border-start border-3 border-warning' : subcategory.is_active,
          }"
          v-for="subcategory in category.children"
          :key="subcategory.name"
          v-text="subcategory.name"
      ></div>
    </div>
  </div>
</template>
<script>
export default {
  props : ['categories'],
  methods : {
    resetActiveCategories(sentSubCategory){
      this.data.map((category)=>{
        category.children.map((subcategory)=>{
          if(subcategory.is_active && subcategory.id === sentSubCategory.id){
            sentSubCategory = {
              id: null,
              name : 'Course catalog',
            }
          }
          subcategory.is_active = false
        })
      })
      this.$emit('setActiveCategory', sentSubCategory)
    }
  },
  computed: {
    data() {
      const parent = []
      const childCandidates = []

      this.categories.forEach(category => {
        if (!category.parent) {
          category.children = []
          parent.push(category)
        } else {
          childCandidates.push(category)
        }
      })
      childCandidates.forEach(category => {
        parent.forEach(cat => {
          cat.is_active = false
          if (cat.id === category.parent) {
            cat.children.push(category)
          }
        })
      })

      parent.sort((a, b) => a.name.localeCompare(b.name))
      return parent
    }
  }
}
</script>
<style>
.category-text {
  font-weight: bold;
  cursor: pointer;
}
.subcategory:hover{
  border-left: solid 3px black;
}
</style>