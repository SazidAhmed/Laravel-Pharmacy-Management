<template>
  <!-- Side Content -->
  <div class="content-side">
    <!-- Side Overlay Tabs -->
    <div class="block block-transparent pull-x pull-t">
      <ul
        class="nav nav-tabs nav-tabs-alt nav-justified js-tabs-enabled"
        data-toggle="tabs"
        role="tablist"
      >
        <li class="nav-item">
          <a class="nav-link active" href="#so-overview">
            <i class="fa fa-fw fa-bell text-gray mr-1"></i> Notifications
          </a>
        </li>
      </ul>
      <div class="block-content tab-content overflow-hidden">
        <!-- Overview Tab -->
        <div
          class="tab-pane pull-x fade fade-left active show"
          id="so-overview"
          role="tabpanel"
        >
          <!-- Expire -->
          <div class="block">
            <div class="block-header block-header-default">
              <h3 class="block-title">To Be Expired</h3>
              <div class="block-options">
                <button
                  type="button"
                  class="btn-block-option"
                  data-toggle="block-option"
                  data-action="state_toggle"
                  data-action-mode="demo"
                >
                  <i class="si si-refresh"></i>
                </button>
                <button
                  type="button"
                  class="btn-block-option"
                  data-toggle="block-option"
                  data-action="content_toggle"
                >
                  <i class="si si-arrow-up"></i>
                </button>
              </div>
            </div>
            <div class="block-content">
              <!-- Users Navigation -->
              <ul class="nav-items mb-0">
                <li v-for="exp in expireDate" :key="exp.id">
                  <a class="media py-2" href="javascript:void(0)">
                    <div class="mr-3 ml-2 overlay-container overlay-bottom">
                      <img
                        class="img-avatar img-avatar48"
                        :src="'/medicine/' + exp.image"
                        height="60"
                        alt="No Image"
                      />
                      <span
                        class="overlay-item item item-tiny item-circle border border-2x border-white bg-success"
                      ></span>
                    </div>
                    <div class="media-body">
                      <div class="font-w600">{{ exp.name }}</div>
                      <div class="font-size-sm text-muted">
                        Expire Date : {{ exp.expire | myDate }}
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
              <!-- END Users Navigation -->
            </div>
          </div>
        </div>
        <!-- END Overview Tab -->
      </div>
    </div>
    <!-- END Side Overlay Tabs -->
  </div>
  <!-- END Side Content -->
</template>

<script>
export default {
  data() {
    return {
      expireDate: [],
    };
  },
  created() {
    this.expire();
  },
  methods: {
    expire() {
      axios
        .get("/api/expire")
        .then((response) => {
          this.expireDate = response.data;
        })
        .catch((error) => {
          alert("unable to fetch Expire Date");
        });
    },
  },
};
</script>