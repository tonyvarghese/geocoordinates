<template>
  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8">
      <form @submit.prevent="save" id="areaForm">
        <div class="form-group">
          <label for="zip">Postal code</label>
          <input
            type="text"
            class="form-control"
            id="zip"
            v-model="postal_code"
            aria-describedby="zipHelp"
            maxlength="5"
            placeholder="Enter Postal Code"
            name="postal_code"
            v-validate="'required|numeric|length:5'"
          />
          <span v-show="errors.has('postal_code')" class="help text-danger">{{
            errors.first("postal_code")
          }}</span>
          <small id="zipHelp" class="form-text text-muted">
            German postal codes are 5-digit numbers that can also begin with a
            zero.
          </small>
        </div>
        <div class="form-group">
          <label for="locality">Locality</label>
          <input
            type="text"
            class="form-control"
            id="locality"
            placeholder="Locality"
            v-model="locality"
          />
        </div>

        <div class="form-group">
          <label for="latitude">Latitude</label>
          <input
            type="text"
            class="form-control"
            id="latitude"
            placeholder="Latitude"
            v-model="latitude"
            maxlength="7"
          />
        </div>
        <div class="form-group">
          <label for="longitude">Longitude</label>
          <input
            type="text"
            class="form-control"
            id="longitude"
            placeholder="Longitude"
            maxlength="7"
            v-model="longitude"
          />
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <!--end of col-->
  </div>

  <!-- /.row -->
</template>

<script>
export default {
  data() {
    return {
      postal_code: "",
      locality: "",
      latitude: "",
      longitude: "",
    };
  },
  mounted() {},
  methods: {
    save() {
      this.$validator.validate().then((valid) => {
        if (valid) {
          axios
            .post("/area/save", {
              locality: this.locality,
              latitude: this.latitude,
              longitude: this.longitude,
              postal_code: this.postal_code,
            })
            .then((response) => {
              switch (response.status) {
                case 200:
                  Swal.fire("New Area Added");
                  this.latitude = "";
                  this.longitude = "";
                  this.postal_code = "";
                  this.locality = "";
                  document.forms[0].reset();
                  this.$validator.reset();
                  break;

                default:
                  //   Swal.fire(response); // end up here all the time
                  break;
              }
            })
            .catch((error) => {
              this.$setLaravelValidationErrorsFromResponse(error.response.data);
            });
        }
      });
    },
    resetForm() {},
  },
};
</script>
