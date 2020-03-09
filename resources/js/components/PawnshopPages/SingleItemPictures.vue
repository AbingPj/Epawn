<style scoped lang="scss">
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

.carousel-item {
	text-align: center;
	img {
		height: 500px;
		width: 550px;
		object-fit: cover;
	}
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
	height: 100px;
	width: 100px;
	outline: black;
	background-size: 100%, 100%;
	border-radius: 50%;
	border: 1px solid  #f57224;
	background-image: none;
}

.carousel-control-next-icon:after {
	content: ">";
	font-size: 55px;
	color:  #f57224;
}

.carousel-control-prev-icon:after {
	content: "<";
	font-size: 55px;
	color:  #f57224;
}
</style>
<template >
	<div>
		<div class="picture-frame">
			<div class="picture" @click="showModal()">
				<img v-bind:src="`../../images/` + data.item_photo" />
			</div>
			<div class="picture" @click="showModal()">
				<img v-bind:src="`../../images/` + data.photo_1" />
			</div>
			<div class="picture" @click="showModal()">
				<img v-bind:src="`../../images/` + data.photo_2" />
			</div>
			<div class="picture" @click="showModal()">
				<img v-bind:src="`../../images/` + data.photo_3" />
			</div>
			<!-- <div class="picture" @click="showModal()">
				<img v-bind:src="`../../images/` + newData.photo_4" />
         </div>-->
		</div>

		<!-- The Modal -->
		<div class="modal" id="myModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
                  <h3 style="color: #f57224;">{{data.item_name}}</h3>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body">
						<div id="demo" class="carousel slide" data-ride="carousel">
							<!-- Indicators -->
							<ul class="carousel-indicators">
								<li data-target="#demo" data-slide-to="0" class="active"></li>
								<li data-target="#demo" data-slide-to="1"></li>
								<li data-target="#demo" data-slide-to="2"></li>
								<li data-target="#demo" data-slide-to="3"></li>
								<!-- <li data-target="#demo" data-slide-to="3"></li> -->
							</ul>

							<!-- The slideshow -->
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img :src="'../../images/' + data.item_photo" />
								</div>
								<div class="carousel-item">
									<img :src="'../../images/' + data.photo_1" />
								</div>
								<div class="carousel-item">
									<img :src="'../../images/' + data.photo_2" />
								</div>
								<div class="carousel-item">
									<img :src="'../../images/' + data.photo_3" />
								</div>
								<!-- <div class="carousel-item">
									<img :src="`../../images/` + newData.photo_4" />
                        </div>-->
							</div>

							<!-- Left and right controls -->
							<a class="carousel-control-prev" href="#demo" data-slide="prev">
								<span class="carousel-control-prev-icon"></span>
							</a>
							<a class="carousel-control-next" href="#demo" data-slide="next">
								<span class="carousel-control-next-icon"></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: ["data"],
	created() {
		this.newData = this.data;
	},
	data() {
		return {
			newData: []
		};
	},
	methods: {
		showModal() {
			$("#myModal").modal("show");
		}
	}
};
</script>