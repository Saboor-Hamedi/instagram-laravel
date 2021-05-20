<template>
  <div>
    <button
      class="btn btn-primary btn-sm ml-3"
      @click="followUser"
      v-text="buttonText"
    ></button>
  </div>
</template>
<script>
export default {
  props: ["userId", "follows"],
  mounted() {
    console.log("Component mounted.");
  },
  data: function () {
    return {
      status: this.follows,
    };
  },
  methods: {
    followUser() {
      axios.post("/follow/" + this.userId).then((respond) => {
        this.status = !this.status;
      });
    },
  },
  computed: {
    buttonText() {
      return this.status ? "Unfollowed" : "Followed";
    }
  }
};
</script>
