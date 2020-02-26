<template>
  <div class="parent-div">
    <div class="custom-card">
      <div class="row">
        <div class="custom-card-image col-md-5 col-lg-7 col-xl-4">
          <img v-bind:src="`../../images/${data[0].item_photo}`" />
        </div>
        <!-- {{data[0].user_id}} -->
        <div class="custom-card-body col-md-7 col-lg-5 col-xl-8">
          <div class="custom-card-name">
            {{data[0].item_name}}
           
          </div>
         
          <div class="custom-card-category">{{data[0].category_name}}</div>
          <div class="custom-card-date">{{data[0].date}}</div>
          <div class="custom-card-description">{{data[0].item_description}}</div>
        </div>
      </div>

    <single-item-pictures :data="data[0]"></single-item-pictures>
    
      <!-- <div class="picture-frame">
        <div class="picture" v-on:click="viewGalleryPhoto(profilePicture)">
          <img v-bind:src="`../../images/${profilePicture}`" />
        </div>
        <div
          class="picture"
          v-for="picture in pictures"
          v-bind:key="picture.item_id"
          v-on:click="viewGalleryPhoto(picture.item_photos)"
        >
          <img v-bind:src="`../../images/${picture.item_photos}`" />
        </div>
      </div> -->

      <div class="row mt-3"> 
        <div class="col-12"> 
          <button class="bid-button" v-on:click="placeBid()"> <i class="fa fa-money mr-2" aria-hidden="true"></i> Appraise </button>
        </div>
      </div>
    </div>

    <div class="bider-card">
      <div class="bider-card-header"> Pawner Information </div>
      <div class="bider-card-body"> 
        <div class="row">
          <div class="bider-photo col-md-5 col-lg-7 col-xl-3"> 
            <img v-bind:src="`../../images/${userDetails[0].image}`">
          </div>
                <div class="bider-info col-md-7 col-lg-5 col-xl-9">
          <div class="row">
             <div class="bider-name col-12"> <i class="fa fa-address-book mr-2" aria-hidden="true"></i> {{userDetails[0].fname}} </div>
             <div class="bider-address col-12 mt-3"><i class="fa fa-map-marker mr-2" aria-hidden="true"></i> {{userDetails[0].address}}</div>
             <div class="col-12 mt-3"> <i class="fa fa-phone-square" aria-hidden="true"></i> {{userDetails[0].contact}}</div>
          </div>
       </div>
        </div>
  
      </div>
    </div>
  </div>
</template>
<style scoped>
.bider-info{
  border-left: 2px solid #eff0f5;
}
.bider-photo img{
  border-radius: 50%;
  height: 200px;
}
.custom-card{
  border: 2px solid #f57224 !important; 
}
.bider-card {
  background-color: white;
  margin-top: 45px;
  padding: 15px;
  border: 2px solid #f57224;
}
.bider-card-header{
  color:#f57224;
  font-size: 20px;
}
.bid-button {
  margin-left: 10px;
  font-size: 20px;
  border: none;
  height: 3 0px;
  width: 97%;
    background: #f57224;
  color: white;
}
.picutre-frame {
  width: 100%;
  display: block;
}
.custom-card-date {
  font-size: 17px;
  font-weight: bold;
  color: #f57224;
}
.picture-frame {
  border-top: 2px solid #eff0f5;
  padding-top: 10px;
  margin-top: 10px;
}
.picture {
  width: 10%;
  border: 2px #f57224 solid;
  margin-left: 2px;

  cursor: pointer;
  display: inline-block;
}
.picture img {
  height: 80px;
  width: 100%;
}
.parent-div {
  font-family: "Roboto";
  margin: 3% 10%;
 
}
.custom-card-name {
  font-size: 33px;
  border-bottom: 2px #f57224 solid;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: left;
  margin-bottom: 2%;
  font-weight: bold;
}
.custom-card-category {
  color: #f57224;
  font-size: 17px;
  font-weight: bold;
}
.custom-card-description {
  font-size: 15px;
  height: 170px;
  width: 100%;
  overflow-y: scroll;
}
.custom-card {
  padding: 5px;
   background-color: white;

  border: 3px white solid;
}
.custom-card-image {
  /* background-color: red; */
  width: max-content;
  display: inline-block;
}
.custom-card-image img {
  height: 300px;
  width: 300px;
}
.custom-card-body {
  width: 100%;
}
</style>
<script>
import AuthService from "../../services/auth";
import PostItemService from '../../services/PostItem.controller';
import UserService from '../../services/User.controller';

export default {
  mounted(){
  AuthService.methods
      .isLogedIn()
      .then(() => {})
      .catch(e => {
        this.$router.push({path: "/Login"});
      });

    this.viewSingleItem();
    this.viewItemPictures();
    setTimeout(()=>{
      this.getUserDetails();
    } , 500)
  },
  created() {
    AuthService.methods
      .isLogedIn()
      .then(() => {})
      .catch(e => {
        this.$router.push({path: "/Login"});
      });

    this.viewSingleItem();
    this.viewItemPictures();
    setTimeout(()=>{
      this.getUserDetails();
    } ,1500)
   
  },
  data: () => {
    return {
      data: [],
      pictures: [],
      profilePicture: "",
      userDetails : [],
      customerID : ''
    };
  },
  methods: {
    viewSingleItem() {
      PostItemService.methods.getSingleItem(this.$route.query.itemId).then( res =>{
        console.info('value of res is' , res)
        this.data = [...res];
        this.profilePicture = this.data[0].item_photo || undefined;
      });
    },
    viewItemPictures() {
      PostItemService.methods.getItemPictures(this.$route.query.itemId).then( res => {
        this.pictures = [...res];
      })
    },
    getUserDetails(){
      console.info('pota' , this.customerID)
      UserService.methods.getUserDetails(this.data[0].user_id).then(res =>{
        this.userDetails = [...res];
        console.info('sad', res)
      })
    },
    viewGalleryPhoto(photo){
      this.data[0].item_photo = photo;
    },
    placeBid(){
      let obj = {itemId : this.$route.query.itemId , biderId : this.userDetails[0].user_id};
      this.$router.push({path : `/Bidding/${obj.itemId}/bidderId/${obj.biderId}` , query: obj })
    }
  }
};
</script>