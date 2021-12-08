<template>
     <div class="row row-deck">
        <div class="col-6 col-sm-3 col-xl-3">
            <div class="block block-rounded d-flex flex-column">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="font-size-h2 font-w700">{{countCat}}</dt>
                        <dd class="text-muted mb-0">Categories</dd>
                    </dl>
                    <div class="item item-rounded bg-body">
                        <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    <a class="font-w500 d-flex align-items-center" :href="urlCat">
                        View all
                        <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3 col-xl-3">
            <div class="block block-rounded d-flex flex-column">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="font-size-h2 font-w700">{{countManu}}</dt>
                        <dd class="text-muted mb-0">Manufactures</dd>
                    </dl>
                    <div class="item item-rounded bg-body">
                        <i class="fa fa-users font-size-h3 text-primary"></i>
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    <a class="font-w500 d-flex align-items-center" :href="urlManu">
                        View All
                        <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3 col-xl-3">
            <div class="block block-rounded d-flex flex-column">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="font-size-h2 font-w700">{{countMed}}</dt>
                        <dd class="text-muted mb-0">Medicines</dd>
                    </dl>
                    <div class="item item-rounded bg-body">
                        <i class="fa fa-inbox font-size-h3 text-primary"></i>
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    <a class="font-w500 d-flex align-items-center" :href="urlMed">
                        View All
                        <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3 col-xl-3">
            <div class="block block-rounded d-flex flex-column">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="font-size-h2 font-w700">{{countCus}}</dt>
                        <dd class="text-muted mb-0">Customers</dd>
                    </dl>
                    <div class="item item-rounded bg-body">
                        <i class="fa fa-inbox font-size-h3 text-primary"></i>
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    <a class="font-w500 d-flex align-items-center" :href="urlCus">
                        View All
                        <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  data() {
    return {
      countCat: "",
      urlCat: "categorypage",
      countManu: "",
      urlManu: "manufacturpage",
      countMed: "",
      urlMed: "productpage",
      countCus: "",
      urlCus:"customerpage"
    };
  },
  created() {
    this.totalEarning();
  },
  methods: {
    totalEarning() {
      axios
        .get("/api/countItems")
        .then((response) => {
          let record = response.data;
          this.countCat = record.countCat;
          this.countManu = record.countManu;
          this.countMed = record.countMed;
          this.countCus = record.countCus;
        })
        .catch((error) => {
          alert("unable to fetch counts");
        });
    },
  },
};
</script>