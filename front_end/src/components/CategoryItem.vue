<template>
  <div>
    <div
        @click="setActiveCategory"
        class="text-start category-text"
        :class="{
          'ps-4 mt-1 subcategory border-start border-3 border-warning': category.is_active,
        }"
        v-text="category.name"
    ></div>

    <div v-if="category.children && category.children.length">
      <CategoryItem
          class="ms-2"
          v-for="child in category.children"
          :key="child.id"
          :category="child"
          @reset="resetActiveCategories"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: "CategoryItem",
  props: {
    category: Object
  },
  methods: {
    setActiveCategory(selected) {
      this.$emit('reset')
      this.$emit('setActiveCategory')
    },
    resetActiveCategories() {
      const reset = (cat) => {
        cat.is_active = false;
        cat.children?.forEach(reset);
      };
      reset(this.category);
    }
  },
};
</script>

<style scoped>
.subcategory {
  cursor: pointer;
}
.active-category {
  font-weight: bold;
  border-left: 3px solid orange;
}
</style>
