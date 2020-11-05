<!--星レビュー機能-->

<template>
  <div class="col-8" id="review_score">
    <star-rating
      :star-size="30"
      v-model="rating"
      v-bind:increment="1"
      v-bind:max-rating="5"
      @rating-selected="setRating"
      v-bind:rounded-corners="false"
    ></star-rating>
    <input type="hidden" name="review_score" :value="rating" />
  </div>
</template>

<script>
import StarRating from "vue-star-rating";

Vue.component("star-rating", StarRating);

export default {
  name: "StarComponent",

  data: function () {
    return {
      rating: 0,
    };
  },
  methods: {
    setRating: function (rating) {
      this.rating = rating;
    },
  },
};
</script>