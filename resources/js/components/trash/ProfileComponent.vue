<template>
  <div class="parent-div">
      <div class="row mb-2"> 
      <div class="col-6"> 
        <button type="button" class="btn btn-outline-success " @click="goBack()"> <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back</button>
      </div>
    </div>
    <div class="custom-row">
      <div class="profile-col"></div>
      <img
        v-if="!isEditable"
        class="user-profile"
        style="width: 300px; height: 300px;"
        v-bind:title=" isEditable? 'Click to change Profile' : ''"
        v-bind:src="(profile.image == '' || profile.image == undefined)? '../../images/no-profile.png': `../../images/${profile.image}`"
      />

      <img
        v-if="isEditable"
        class="user-profile"
        :src="(editableImages.profile == '') ? '../../images/no-profile.png' :  editableImages.profile"
      />

      <input type="file" @change="onProfileChange" v-if="isEditable" class="form-control" />

      <div class="information-panel">
        <div class="information-header">Personal Information</div>
        <div class="information-body">
          <div class="username">
            <div class="row">
              <div class="col-12">
                <i class="fa fa-address-card" aria-hidden="true"></i>
                <small class="text-colored">Username</small>
                <input v-model="profile.username" class="form-control" placeholder="Username" :disabled="!isEditable" />
              </div>
            </div>
             <div class="row">
              <div class="col-12">
                <i class="fa fa-phone-square" aria-hidden="true"></i>
                <small class="text-colored">Contact #</small>
                <input v-model="profile.contact" class="form-control" placeholder="Contact #" :disabled="!isEditable" />
              </div>
            </div>
             <div class="row">
              <div class="col-12">
                <i class="fa fa-flag" aria-hidden="true"></i>
                <small class="text-colored"> # of months for the item to be confiscated</small>
                <input v-model="profile.monthConfescation" class="form-control" placeholder="Contact #" :disabled="!isEditable" />
              </div>
            </div>
          </div>
          <div class="address">
            <div class="row mb-2">
              <div class="col-12">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <small class="text-colored">Address</small>
                <input v-model="profile.address" class="form-control" placeholder="Address" :disabled="!isEditable" />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="information-panel">
        <div class="information-header">Business Information</div>
        <div class="information-body row">
          <div class="col">
            <img
              v-if="!isEditable"
              class="business-permit"
              style="height: 95px; margin: 4px 0;"
              v-bind:title=" isEditable? 'Click to change business permit picture' : ''"
              v-bind:src="(profile.business_permit == '' || profile.business_permit == undefined) ? `../../images/no-image.png`: `../../images/${profile.business_permit}`"
            />
            <img
              v-if="isEditable"
              style="height: 95px; margin: 4px 0;"
              :src="(editableImages.permit == '') ? '../../images/no-image.png' :  editableImages.permit"
            />
            <input type="file" class="form-control" @change="onPermitChange" v-if="isEditable" />

            <div class="row mb-2">
              <div class="col-12">
                <i class="fa fa-book" aria-hidden="true"></i>
                <small class="text-colored">Business permit</small>
              <input v-model="profile.control_num" class="form-control" :disabled="!isEditable" placeholder="Business Control #.." />
              </div>
            </div>
      
          </div>
        </div>
      </div>

      <div v-if="!isEditable">
        <div class="information-panel">
          <div class="information-header">
            Packages
            <i
              v-on:click="launchPackageModal()"
              class="fa fa-plus-square mr-1"
              style="float: right; cursor: pointer; font-size: 35px;"
              aria-hidden="true"
            ></i>
          </div>
          <div class="information-body mt-2">
            <div
              v-for="(single_pack, index) in packages"
              v-bind:key="single_pack.package_id"
              style="width: 90%;border: 2px #f57224 solid; margin-bottom: 10px;"
            >
              <div style="background-color: #f57224; color: white; ">
                <span style="margin-left: 10px;">{{single_pack.package_name}}</span>

                <div style="display : inline;">
                  <button
                    class="custom-button"
                    style="background-color: #f57224; border: 2px white solid; color: white; margin-left: 30px; height : 24px; font-size: 12px; line-height: 24px; "
                    v-if="!packEditable"
                    v-on:click="enablePackageEditing(index)"
                  >
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                    Edit
                  </button>
                  <button
                    class="custom-button"
                    style="background-color: #f57224; border: 2px white solid; color: white; margin-left: 2.5px;height : 24px; font-size: 12px; line-height: 24px; "
                    v-if="!packEditable"
                    v-on:click="removePackage(index)"
                  >
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    Remove
                  </button>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <small style="margin-left: 10px; color:  #f57224;">Package Description</small>
                  <br />
                  <span style="margin-left: 10px;">{{single_pack.package_description}}</span>
                </div>
              </div>
              <div v-for="duration in durations" :key="duration.from">
                <div class="row" v-if="duration.package_id == single_pack.package_id">
                  <div class="col-4">
                    <small style="margin-left: 10px;  color:  #f57224;">From</small>
                    <br />
                    <span style="margin-left: 10px;">
                      {{duration.duration_from}}
                      <small>Day</small>
                    </span>
                  </div>
                  <div class="col-4">
                    <small style="margin-left: 10px;  color:  #f57224;">To</small>
                    <br />
                    <span style="margin-left: 10px;">
                      {{duration.duration_to}}
                      <small>Day</small>
                    </span>
                  </div>
                  <div class="col-4">
                    <small style="margin-left: 10px;  color:  #f57224;">Interest Rate</small>
                    <br />
                    <span style="margin-left: 10px;">
                      {{duration.interestRate}}
                      <small>%</small>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div
              v-if="packages.length == 0"
              class="alert alert-danger"
              role="alert"
            >No Packages yet.</div>
          </div>
        </div>

        <div class="information-panel">
          <div class="information-header">
            Item Category Information
            <i
              v-on:click="launchRequestModal()"
              class="fa fa-plus-square mr-1"
              style="float: right; cursor: pointer; font-size: 35px;"
              aria-hidden="true"
            ></i>
          </div>
          <div class="information-body mt-2">
            <div class="row">
              <div class="col">
                <select class="form-control" v-model="selectedCategory">
                  <option
                    v-for="category in categories"
                    :value="category.category_id"
                    :key="category.category_id"
                  >{{category.category_name}}</option>
                </select>
              </div>
              <div class="col-4">
                <button class="btn btn-success btn-block btn-block" @click="addCategory()">Add</button>
              </div>
            </div>

            <div
              v-if="pawnshop_categories.length == 0"
              class="alert alert-danger mt-2"
              role="alert"
            >No Categories yet.</div>
            <div v-else class="mt-2">
              <div
                style="border: #f57224 2px solid; margin: 4px 4px;"
                v-for="pawnshop_category in pawnshop_categories"
                :key="pawnshop_category.category_id"
              >
                <div style=" color: white; background: #f57224; padding: 5px;">
                  {{pawnshop_category.category_name}}
                  <i
                    class="fa fa-trash"
                    style="font-size: 25px; cursor: pointer; float: right;"
                    @click="removeItemCategory(pawnshop_category)"
                    aria-hidden="true"
                  ></i>
                </div>
                <div style="padding: 5px;">
                  <small style="color:#f57224;">Description</small>
                  <br />
                  {{pawnshop_category.category_description}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="button-container">
        <button class="edit-btn" v-on:click="enableEditing()" v-if="!isEditable">
          <i class="fa fa-pencil" aria-hidden="true"></i> Edit
        </button>
        <button class="save-btn" v-if="isEditable" v-on:click="saveChanges()"
        :style=" isValidToBeSaved() ? 'cursor: no-drop;' : 'cursor: pointer;'"
        :disabled="isValidToBeSaved()">
          <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Changes
        </button>
        <button class="discard-btn" v-on:click="enableEditing()" v-if="isEditable">
          <i class="fa fa-ban" aria-hidden="true"></i> Cancel
        </button>
      </div>
    </div>

    <!-- Package trigger modal -->

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <i class="fa fa-archive" aria-hidden="true"></i> Add Package
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-6">
                <small>Name</small>
                <input class="form-control" v-model="pack.package_name" />
              </div>
              <div class="col-6">
                <small>Description</small>
                <input class="form-control" v-model="pack.package_description" />
              </div>
            </div>

            <div class="row mt-2">
              <div class="col-12">
                <button
                  type="button"
                  class="btn btn-secondary"
                  v-on:click="addDuration()"
                >Add Duration</button>
              </div>
            </div>
            <!-- duration of the package  -->

            <div
              class="row"
              v-for="(duration, index) of pack.duration"
              v-bind:key="duration.duration_from"
            >
              <div class="col-4">
                <small>From Day :</small>
                <input class="form-control" disabled type="number" v-model="duration.duration_from" />
              </div>
              <div class="col-4">
                <small>To Day :</small>
                <input
                  class="form-control"
                  type="number"
                  v-bind:disabled="toDisabled"
                  v-on:input="editDuration(index)"
                  v-model="duration.duration_to"
                />
              </div>
              <div class="col-4">
                <small>Interest Rate</small>
                <input class="form-control" type="number" v-model="duration.interestRate" />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-primary"
              v-bind:disabled="toDisabled"
              v-on:click="addPackage()"
            >Save changes</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for category acceptance request -->

    <div
      class="modal fade"
      id="requestModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <i class="fa fa-archive" aria-hidden="true"></i> Request an item category
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body row">
            <div class="col-12">
              <small style="color: #f57224;">Category Name</small>
              <br />
              <input type="text" v-model="categoryRequest.category_name" class="form-control" />
            </div>
            <div class="col-12">
              <small style="color: #f57224;">Category Description</small>
              <br />
              <textarea class="form-control" v-model="categoryRequest.category_description"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-primary"
              @click="sendCategoryRequest()"
            >Send Request</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.swal2-timer-progress-bar {
  background-color: #f57224 !important;
}
.form-control {
  width: 100% !important;
}
input {
  width: 70%;
  padding: 2px;
}
.button-container {
  margin: 5px 0px 0px 5px;
}
.text-colored {
  color: #f57224;
}
.edit-btn {
  background-color: #f57224;
  color: white;
  border: none;
  height: 40px;
}
.save-btn {
  background-color: #f57224;
  color: white;
  border: none;
  height: 40px;
}
.discard-btn {
  background-color: #ed3447;
  color: white;
  border: none;
  height: 40px;
}

.button-container button {
  width: 20%;
}

.business-permit {
  height: 170px;
}
.information-panel {
  margin: 25px 5px 0px 5px;
  border: 1px #f57224 solid;
}
.information-body {
  padding-left: 20px;
}
.information-header {
  color: white;
  padding-left: 10px;
  font-size: 25px;
  background-color: #f57224;
}
.parent-div {
  font-family: "Roboto";
  margin: 3% 10%;
  background-color: white;
}
.user-profile {
  border-radius: 50%;
  display: block;
  border: orange 2.5px solid;
  margin: -95px auto 0px auto;
  height: 240px;
}
.custom-row {
  width: 100%;
  padding-bottom: 7px;
}
.profile-col {
  width: 100%;
  height: 150px;
  background-color: #f57224;
}
.details-col {
  display: inline;
}
</style>
<script>
import AuthService from "../services/auth";
import Swal from "sweetalert2";
import UserService from "../services/User.controller";
import PackageService from "../services/Package.controller";

export default {
  data: () => {
    return {
      profile: {
        username : '',
        address : '',
        control_num : '',
        contact : '',
        monthConfescation : ''
      },
      selectedCategory: 1 || 0,
      timer: Object,
      temp: [],
      durations: [
        {
          package_id: null,
          duration_from: 1,
          duration_to: 2,
          interestRate: 1
        }
      ],
      duration: [],
      categoryRequest: {
        category_name: "",
        category_description: "",
        category_user: AuthService.methods.getUid()
      },
      categories: [
        {
          category_id: 0,
          category_name: ""
        }
      ],
      pawnshop_categories: [
        {
          pawnshop_id: 0,
          category_id: 0
        }
      ],
      isEditable: false,
      toDisabled: false,
      packEditable: false,
      pack: {
        package_id: null,
        pawnshop_id: AuthService.methods.getUid(),
        package_interest: "",
        package_days: "",
        package_description: "",
        package_name: "",
        duration:
          [
            {
              duration_from: 1,
              duration_to: 2,
              interestRate: 1
            }
          ] || []
      },
      packages: [
        {
          package_id: null,
          package_name: "",
          package_description: "",
          pawnshop_id: null,
          package_description: "",
          duration: [
            {
              duration_from: 1,
              duration_to: 2,
              interestRate: 1
            }
          ]
        }
      ],
      editableImages: {
        profile: "",
        permit: ""
      },
      blobImages: {
        profile: "",
        permit: ""
      }
    };
  },
  created() {
    this.getUserData();
    this.viewPackages();
    this.viewDurations();
    this.viewCategories();
    this.viewPawnshopCategories();
  },
  methods: {
    removeItemCategory(category) {
      console.info("sample sacaasdsad", category);
      Swal.fire({
        title: "Epawn Application",
        text: "Are you sure to remove this category ?",
        icon: "warning",
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: "Remove",
        cancelButtonText: "Cancel"
      }).then(result => {
        if (result.value) {
          PackageService.methods.removeItemCategory(category).then(res => {
            Swal.fire({
              title: "Epwan Application",
              text: "Category succesfully removed",
              icon: "success"
            });
            this.viewPawnshopCategories();
          });
        }
      });
    },
    isValidToBeSaved(){
      if(this.profile.username.trim().length == 0){
        return true;
      }
      if(this.profile.address.trim().length == 0){
        return true;
      }
      if(this.profile.control_num.trim().length == 0){
        return true;
      }
      if(this.profile.contact.trim().length == 0){
        return true;
      }

      return false;
    },
    addDuration() {
      this.pack.duration.push({
        package_id: this.pack.package_id,
        duration_from:
          Number(
            this.pack.duration[this.pack.duration.length - 1].duration_to
          ) + 1,
        duration_to:
          Number(
            this.pack.duration[this.pack.duration.length - 1].duration_to
          ) + 2,
        interestRate: 1
      });
      for (let key in this.pack.duration) {
        if (this.pack.duration.hasOwnProperty(key)) {
          this.temp.push(this.pack.duration[key].duration_to);
        }
      }
      console.info(this.temp, "temp", this.pack.duration);
    },
    editDuration(index) {
      let _this = this;
      setTimeout(() => {
        _this.toDisabled = true;
        setTimeout(() => {
          _this.toDisabled = false;
          if (
            this.pack.duration[index].duration_to <=
            this.pack.duration[index].duration_from
          ) {
            this.pack.duration[index].duration_to = Number(this.temp[index]);

            // console.info(
            //   index,
            //   "to in temp ",
            //   this.temp[index],
            //   "to in arr",
            //   this.pack.duration[index].to
            // );
            console.info(false);
          }
          for (let i = index; i < this.pack.duration.length; i++) {
            this.pack.duration[i + 1].duration_from =
              Number(this.pack.duration[i].duration_to) + 1;
            this.pack.duration[i + 1].duration_to =
              Number(this.pack.duration[i].duration_to) + 2;
          }

          console.info("inside", this.toDisabled);
        }, 400);
      }, 400);

      console.info("outside", this.toDisabled);
    },
     goBack(){
      this.$router.push({ path : '/'})
    },
    removePackage(index) {
      this.pack = { ...this.packages[index] };
      this.pack.package_id = parseInt(this.pack.package_id || false);
      let _this = this;
      Swal.fire({
        title: "Are you sure to remove this Package?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
          PackageService.methods.removePackage(_this.pack).then(res => {
            console.info(res);
            _this.viewPackages();
            _this.pack = {
              pawnshop_id: AuthService.methods.getUid(),
              package_interest: "",
              package_days: "",
              package_description: "",
              package_name: ""
            };
          });
        }
      });
    },
    enablePackageEditing(index) {
      this.pack = { ...this.packages[index] };
      this.pack.duration = this.durations.filter(e => {
        return e.package_id === this.pack.package_id;
      });

      console.info("sigle duration ", this.duration);

      $("#exampleModal").modal("show");
    },
    addPackage() {
      if (this.pack.package_id !== null) {
        this.updatePackage();
      } else {
        console.info("conmtent of the pack", this.pack);
        this.pack.package_interest = parseFloat(
          this.pack.package_interest || false
        );
        this.pack.package_days = parseFloat(this.pack.package_days || false);
        PackageService.methods.addToPawnshop(this.pack).then(r => {
          console.info("reg package ");
        });
        for (let i = 0; i < this.pack.duration.length; i++) {
          PackageService.methods.addPackage(this.pack.duration[i]).then(res => {
            console.info(`${this.pack.duration[i]} is succesfully added`);
          });
        }
        for (let key in this.pack.duration) {
          if (this.pack.duration.hasOwnProperty(key)) {
          }
        }
        Swal.fire({
          title: "Package Added Succesfully",
          toast: true,
          timer: 3000,
          position: "top-right"
        });
      }

      $("#exampleModal").modal("hide");
      this.viewPackages();
      this.viewDurations();
      this.pack = {
        pawnshop_id: AuthService.methods.getUid(),
        package_interest: "",
        package_days: "",
        package_description: "",
        package_name: "",
        duration: [
          {
            from: 1,
            to: 2,
            interestRate: 1
          }
        ]
      };
    },
    updatePackage() {
      this.pack.package_interest = parseFloat(
        this.pack.package_interest || false
      );
      this.pack.package_days = parseInt(this.pack.package_days || false);
      this.pack.package_id = parseInt(this.pack.package_id || false);

      PackageService.methods.editPackage(this.pack).then(res => {
        Swal.fire({
          title: "Package Edited Succesfully",
          toast: true,
          timer: 3000,
          position: "top-right"
        });
        $("#exampleModal").modal("hide");
        // this.packEditable = !this.packEditable;
        this.viewPackages();
        this.pack = {
          pawnshop_id: AuthService.methods.getUid(),
          package_interest: "",
          package_days: "",
          package_description: "",
          package_name: "",
          package_id: null,
          duration: [
            {
              duration_from: 1,
              duration_to: 2,
              interestRate: 1
            }
          ]
        };
      });
    },
    viewPackages() {
      PackageService.methods
        .getPawnshopPackages({ pawnshopId: AuthService.methods.getUid() })
        .then(res => {
          this.packages = [...res];
        });
    },
    viewCategories() {
      PackageService.methods.getItemCategories().then(res => {
        this.categories = [...res];
      });
    },
    viewPawnshopCategories() {
      let category = { pawnshop_id: AuthService.methods.getUid() };
      PackageService.methods.viewPawnshopCategories(category).then(res => {
        this.pawnshop_categories = [...res];
      });
    },
    addCategory() {
      let category = {
        pawnshop_id: AuthService.methods.getUid(),
        category_id: this.selectedCategory
      };
      PackageService.methods.addItemCategory(category).then(
        res => {
          this.viewCategories();
          Swal.fire({
            text: "Category succesfully added",
            timer: 3000,
            icon: "success"
          });
        },
        err => {
          Swal.fire({
            text: "Category already added",
            timer: 3000,
            icon: "error"
          });
        }
      );
      this.viewPawnshopCategories();
    },
    viewDurations() {
      PackageService.methods.viewDurations().then(res => {
        this.durations = [...res];
      });
    },
    launchPackageModal() {
      this.pack = {
        pawnshop_id: AuthService.methods.getUid(),
        package_interest: "",
        package_days: "",
        package_description: "",
        package_name: "",
        package_id: null,
        duration: [
          {
            duration_from: 1,
            duration_to: 2,
            interestRate: 1
          }
        ]
      };
      $("#exampleModal").modal("show");
    },
    launchItemModal() {
      $("#itemModal").modal("show");
    },
    getUserData() {
      UserService.methods
        .getUserDetails(window.localStorage.getItem("userId"))
        .then(res => {
          this.profile = { ...res[0] };
          console.info("profile data", this.profile);
        });
    },
    enableEditing(value) {
      this.isEditable = !this.isEditable;
    },
    saveChanges() {
      let user = {
        userId: AuthService.methods.getUid(),
        fname: this.profile.username,
        business_permit: this.profile.business_permit,
        control_num: this.profile.control_num,
        address: this.profile.address,
        confiscated : this.profile.monthCofescation
      };
      let formData = new FormData();
      formData.append("userId", user.userId);
      formData.append("permit", this.blobImages.permit);
      formData.append("profile", this.blobImages.profile);
      formData.append("fname", user.fname);
      formData.append("address", user.address);
      formData.append("control_num", user.control_num);
      formData.append("contact", this.profile.contact);
       formData.append("confiscated", this.profile.monthCofescation);

      UserService.methods.changeProfile(formData).then(res => {
        Swal.fire({
          title: "Epawn Application",
          text: "Changes Successfully Saved",
          icon: "success"
        });
        this.getUserData();
        this.isEditable = !this.isEditable;
      });
    },
    launchRequestModal() {
      $("#requestModal").modal("show");
    },
    sendCategoryRequest() {
      PackageService.methods.sendCategoryRequest(this.categoryRequest).then(
        e => {
          Swal.fire({
            title: "Category Request Sent Succesfully",
            icon: "success"
          });
          this.categoryRequest = {
            category_name: "",
            category_description: "",
            category_user: AuthService.methods.getUid()
          };
          $("#requestModal").modal("hide");
        },
        err => {
          Swal.fire({
            title: "Sending Request went wrong",
            icon: "error"
          });
        }
      );
    },
    onProfileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.blobImages.profile = files[0];
      this.createImage(files[0], "profile");
    },
    onPermitChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.blobImages.permit = files[0];
      this.createImage(files[0], "permit");
    },
    createImage(file, type) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = e => {
        if (type == "permit") {
          vm.editableImages.permit = e.target.result;
        } else {
          vm.editableImages.profile = e.target.result;
        }
      };
      reader.readAsDataURL(file);
    }
  }
};
</script>