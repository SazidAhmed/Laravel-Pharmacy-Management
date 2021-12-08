<template>
  <div class="content content-boxed">
    <!-- Invoice -->
    <div class="block block-rounded">
      <div class="block-header">
        <h3 class="block-title">#INV{{ invoice.id }}</h3>
        <div class="block-options">
          <!-- Print Page functionality is initialized in Helpers.print() -->
          <button
            type="button"
            class="btn-block-option"
            onclick="One.helpers('print');"
          >
            <i class="si si-printer mr-1"></i> Print Invoice
          </button>
        </div>
      </div>
      <div class="block-content">
        <div class="p-sm-4 p-xl-7">
          <!-- Invoice Info -->
          <div class="row mb-4">
            <!-- Company Info -->
            <div class="col-6 font-size-sm">
              <p class="h3">M R Medicine Corner</p>
              <address>
                Street Address<br />
                Motijhil, Dhaka.<br />
                +8801680800810<br />
                mrmedicine@gmail.com
              </address>
            </div>
            <!-- END Company Info -->

            <!-- Client Info -->
            <div class="col-6 text-right font-size-sm">
              <p>{{ invoice.created_at | myDate }}</p>
              <address>
                {{ customerName }}<br />
                {{ customerPhone }}<br />
                {{ customerAddress }}
              </address>
            </div>
            <!-- END Client Info -->
          </div>
          <!-- END Invoice Info -->

          <!-- Table -->
          <div class="table-responsive push">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center" style="width: 60px"></th>
                  <th>Product</th>
                  <th class="text-center" style="width: 90px">Qty</th>
                  <th class="text-right" style="width: 120px">Unit</th>
                  <th class="text-right" style="width: 120px">Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in invoiceItems" :key="index">
                  <td class="text-center">{{ index + 1 }}</td>
                  <td>
                    <p class="font-w600 mb-1 text-muted">
                      {{ item.medicine.name }}
                    </p>
                  </td>
                  <td class="text-center">{{ item.qty }}</td>
                  <td class="text-right">৳ {{ item.medicine.price }}</td>
                  <td class="text-right">৳ {{ item.amount }}</td>
                </tr>
                <tr>
                  <td colspan="4" class="font-w600 text-right">Subtotal</td>
                  <td class="text-right">৳ {{ invoice.payment }}</td>
                </tr>
                <tr>
                  <td colspan="4" class="font-w600 text-right">Discount</td>
                  <td class="text-right">৳ 0</td>
                </tr>
                <tr>
                  <td
                    colspan="4"
                    class="font-w700 text-uppercase text-right bg-body-light"
                  >
                    Total Payment
                  </td>
                  <td class="font-w700 text-right bg-body-light">
                    ৳ {{ invoice.payment - 0 }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- END Table -->

          <!-- Footer -->
          <p class="font-size-sm text-muted text-center py-3 my-3 border-top">
            Thank you. Get Well Soon !
          </p>
          <!-- END Footer -->
        </div>
      </div>
    </div>
    <!-- END Invoice -->
  </div>
</template>
<script>
export default {
  data() {
    return {
      customerName: [],
      customerPhone: [],
      customerAddress: [],
      invoice: [],
      invoiceItems: [],
    };
  },
  created() {
    this.getInvoice();
  },
  methods: {
    //Invoice
    getInvoice() {
      // spliting url and getting invoice Id
      let path = window.location.pathname;
      let segments = path.split("/");
      // console.log(segments);
      axios
        .get("/invoiceGenerator/" + segments[2])
        .then((response) => {
          this.invoice = response.data;
          let customerDetails = this.invoice.customer;
          this.customerName = customerDetails.name;
          this.customerPhone = customerDetails.phone;
          this.customerAddress = customerDetails.address;
          //invoiceItems
          this.invoiceItems = this.invoice.invoiceItems;
        })
        .catch((error) => {
          alert("unable to fetch InvoiceID");
        });
    },
  },
};
</script>