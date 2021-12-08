<template>
  <div class="row">
    <div class="col-6 col-md-3 col-lg-6 col-xl-3">
      <a
        class="block block-rounded block-link-pop border-left border-primary border-4x"
        href="javascript:void(0)"
      >
        <div class="block-content block-content-full">
          <div class="font-size-sm font-w600 text-uppercase text-muted">
            Today Earnings
          </div>
          <div class="font-size-h2 font-w400 text-dark">৳ {{ todayTotal }}</div>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-3 col-lg-6 col-xl-3">
      <a
        class="block block-rounded block-link-pop border-left border-primary border-4x"
        href="javascript:void(0)"
      >
        <div class="block-content block-content-full">
          <div class="font-size-sm font-w600 text-uppercase text-muted">
            Weekly Earnings
          </div>
          <div class="font-size-h2 font-w400 text-dark">
            ৳ {{ thisWeekTotal }}
          </div>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-3 col-lg-6 col-xl-3">
      <a
        class="block block-rounded block-link-pop border-left border-primary border-4x"
        href="javascript:void(0)"
      >
        <div class="block-content block-content-full">
          <div class="font-size-sm font-w600 text-uppercase text-muted">
            Monthly Earnings
          </div>
          <div class="font-size-h2 font-w400 text-dark">
            ৳ {{ thisMonthTotal }}
          </div>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-3 col-lg-6 col-xl-3">
      <a
        class="block block-rounded block-link-pop border-left border-primary border-4x"
        href="javascript:void(0)"
      >
        <div class="block-content block-content-full">
          <div class="font-size-sm font-w600 text-uppercase text-muted">
            Avg Sale
          </div>
          <div class="font-size-h2 font-w400 text-dark">৳ {{ monthlyAvg }}</div>
        </div>
      </a>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      todayTotal: "",
      thisWeekTotal: "",
      thisMonthTotal: "",
      monthlyAvg: "",
    };
  },
  created() {
    this.totalEarning();
  },
  methods: {
    totalEarning() {
      axios
        .get("/api/totalEarning")
        .then((response) => {
          let record = response.data;
          this.todayTotal = record.todayTotal;
          this.thisWeekTotal = record.thisWeekTotal;
          this.thisMonthTotal = record.thisMonthTotal;
          this.monthlyAvg = record.monthlyAvg;
        })
        .catch((error) => {
          alert("unable to fetch total Earnings");
        });
    },
  },
};
</script>
<style type="text/css">
.danger {
  color: red;
}
</style>