<template>
  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8">
      <form @submit.prevent="save">
        <div class="form-group">
          <label for="zip">Postal code</label>
          <select
            name="zip"
            class="form-control"
            v-model="area_id"
            v-validate="'required'"
          >
            <option value="">Select Postal Code</option>
            <option v-for="area in areas" :key="area.id" :value="area.id">
              {{ area.postal_code }}
            </option>
          </select>
          <span v-show="errors.has('zip')" class="help text-danger">{{
            errors.first("zip")
          }}</span>
        </div>
        <div class="form-group">
          <label for="street">Street</label>
          <input
            type="text"
            v-model="street"
            class="form-control"
            id="street"
            placeholder="Street"
            v-validate="'required|min:3|max:30'"
            name="street"
          />
          <span v-show="errors.has('street')" class="help text-danger">{{
            errors.first("street")
          }}</span>
        </div>

        <div class="form-group">
          <label for="latitude">Latitude</label>
          <input
            type="text"
            class="form-control"
            v-model="latitude"
            id="latitude"
            placeholder="Latitude"
          />
        </div>
        <div class="form-group">
          <label for="longitude">Longitude</label>
          <input
            type="text"
            class="form-control"
            id="longitude"
            v-model="longitude"
            placeholder="Longitude"
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
      areas: {},
      locality: "",
      latitude: "",
      longitude: "",
      area_id: "",
      street: "",
    };
  },
  mounted() {
    axios.get("/areas").then((response) => {
      this.areas = response.data;
    });
  },
  methods: {
    save() {
      this.$validator.validate().then((valid) => {
        if (valid) {
          axios
            .post("/street/save", {
              latitude: this.latitude,
              longitude: this.longitude,
              area_id: this.area_id,
              street: this.street,
            })
            .then((response) => {
              switch (response.status) {
                case 200:
                  Swal.fire("New Street Added");
                  this.latitude = "";
                  this.longitude = "";
                  this.area_id = "";
                  this.street = "";
                  document.forms[0].reset();
                  this.$validator.reset();

                  break;
                case 422:
                  alert(response.errors);
                default:
                  Swal.fire(response); // end up here all the time
                  break;
              }
            })
            .catch((error) => {
              this.$setLaravelValidationErrorsFromResponse(error.response.data);
            });
        }
      });
    },
  },
};
</script>
