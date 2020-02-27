<template>
    <div>
         <div class="modal" tabindex="-1" role="dialog" id="modalPawning">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Pawning Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- declineActive == false -->
            
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"># of days to notify before it hits the deadline</span>
                </div>
                <input type="text" class="form-control"  />
                <div class="input-group-append">
                  <span class="input-group-text">Days</span>
                </div>
              </div>

              <!-- <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Item's Extension for the User</span>
                </div>
                <input type="text" class="form-control" v-model="pawning_info.ext_months" />
                <div class="input-group-append">
                  <span class="input-group-text">Months</span>
                </div>
              </div>-->

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Package</label>
                </div>
                <select
                  class="custom-select"
                  id="inputGroupSelect01"
                
                >
                  <!-- <option
                    v-for="my_package in packages"
                    :value="my_package.package_id"
                    :key="my_package.package_id"
                  >{{my_package.package_name}}</option> -->
                </select>
              </div>

              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Pawn Agreement Information</h5>
                  <small class="form-label" style="color: #f57224;">Bid Amount</small>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <button
                        class="btn"
                      
                       
                        type="button"
                      >Change Amount</button>
                    </div>
                    <input
                      type="number"
                      class="form-control"

                      placeholder
                      aria-label
                      aria-describedby="basic-addon1"
                    />
                  </div>
                  <div class="row text-center">
                    <div class="col">
                      <small>Duration</small>
                    </div>
                    <div class="col">
                      <small># of Days</small>
                    </div>
                    <div class="col">
                      <small>interest rate</small>
                    </div>
                    <div class="col">
                      <small>duration's interest</small>
                    </div>
                  </div>
                  <div
                    class="row text-center"
                    style="font-size: 14px;"
                  
                  >
                    <div class="col">
                      Day
                    
                    </div>
                    <div class="col">
                    </div>
                    <div class="col">
                    </div>
                    <div class="col">
                    </div>
                  </div>
                </div>
              </div>
            
            

            <!-- <div class="row">
              <div class="col">
                <button
                  class="btn btn-success btn-block"
                  @click="pawnItem()"
                  :disabled="declineActive || (pawning_info.notif_days.trim().length == 0 || pawning_info.package == 0)"
                >Accept</button>
              </div>
              <div class="col">
                <button
                  class="btn btn-danger btn-block"
                  v-if="declineActive == false"
                  @click="declineActive = !declineActive"
                >Decline</button>
                <div class="row" v-if="declineActive == true" style="padding: 0px !important;">
                  <div class="col">
                    <button
                      class="btn btn-success btn-block"
                      @click="declineItem()"
                      :disabled="pawning_info.reason.trim().length == 0"
                    >Confirm</button>
                  </div>
                  <div class="col">
                    <button
                      class="btn btn-danger btn-block"
                      @click="declineActive = !declineActive"
                    >Cancel</button>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
        
    </div>
</template>