<template>
  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8">
      <form class="card card-sm mb-3">
        <div class="card-body row no-gutters align-items-center">
          <div class="col-auto">
            <i class="fas fa-search h4 text-body"></i>
          </div>
          <!--end of col-->
          <div class="col">
            <input
              class="form-control form-control-lg form-control-borderless"
              type="search"
              v-model="searchKey"
              @keyup="searchData"
              placeholder="Search topics or keywords"
            />
          </div>
          <!--end of col-->
        </div>
      </form>

      <div v-for="result in searchResult" :key="result.id" class="row">
        <div class="col-12"><b>Zip Code: </b>{{ result.area.postal_code }}</div>
        <div class="col-12"><b>Street: </b>{{ result.route }}</div>
        <div class="col-12"><b>Latitude: </b>{{ getLatitude(result) }}</div>
        <div class="col-12"><b>Longitude: </b>{{ getLongitude(result) }}</div>

        <hr class="col-12" />
      </div>
    </div>
    <!--end of col-->
  </div>

  <!-- /.row -->
</template>

<script>
export default {
  data() {
    return {
      searchResult: {},
      searchKey: "",
    };
  },
  mounted() {},
  methods: {
    searchData() {
      axios
        .post("/street/search", {
          search: this.searchKey,
        })
        .then((response) => {
          this.searchResult = response.data;
        });
    },
    getLatitude(result) {
      return result.latitude ? result.latitude : result.area.latitude;
    },
    getLongitude(result) {
      return result.longitude ? result.longitude : result.area.longitude;
    },
  },
};
</script>
