<template>
  <div>
  <div class="row">
    <div class="col-md-12" v-if="allmessages.messages != '' " style="margin-top: 15px;">
      <div class="card">
        <div class="card-header text-center myrow">
          <strong style="font-size:16px;"> Chat with Support </strong> 
        </div>
        <div class="card-body chat-msg" v-chat-scroll>
          <ul class="chat" v-for="(msg, index) in allmessages.messages" :key="index">
            
            <!-- admin part  -->
            <li class="sender clearfix" v-if="allmessages.myId != msg.user.id">
              <span class="chat-img left clearfix mx-2">
                <img :src="'/admin/img/admins/' + msg.user.image" class="userImg" alt="userImg" />
              </span>
              <div class="chat-body2 clearfix">
                <div class="header clearfix">
                  <strong class="primary-font">{{ msg.user.name }}</strong>
                  <small class="right text-muted">
                    {{ moment(msg.created_at).fromNow() }}
                  </small>
                  <!-- //if send with product id  -->
                  <div class="text-center" v-if="msg.product">
                    <a :href="'/products/'+ msg.product.product_slug_en" target="_blank">
                    {{ msg.product.product_name_en }}
                    <img :src="'/uploads/product/thumbnail/' + msg.product.product_thumbnail" alt="productImg" width="60px;" />
                    </a>
                  </div>
                </div>

                <p>{{ msg.msg }}</p>
              </div>
            </li>

            <!-- my part  -->
            <li class="buyer clearfix" v-else>
              <span class="chat-img right clearfix mx-2">
                <img :src="'/frontend/assets/images/users/' + msg.user.image" class="userImg" alt="userImg" />
              </span>
              <div class="chat-body clearfix">
                <div class="header clearfix">
                  <small class="left text-muted">
                    {{ moment(msg.created_at).fromNow() }}
                  </small><br>
                  <!-- <strong class="right primary-font">{{msg.user.name}}</strong> //my name   -->
                  <div class="text-center" v-if="msg.product">
                    <a :href="'/products/'+ msg.product.product_slug_en" target="_blank">
                    {{ msg.product.product_name_en }}
                    <img :src="'/uploads/product/thumbnail/' + msg.product.product_thumbnail" alt="productImg" width="60px;" />
                    </a>
                  </div>
                </div>
                <p>{{ msg.msg }}</p>
              </div>
            </li>

            <li class="sender clearfix">
              <span class="chat-img left clearfix mx-2"> </span>
            </li>
          </ul>
        </div>
        <div class="card-footer">
          <div class="input-group">
            <input id="btn-input" type="text" v-model="msg" class="form-control " placeholder="Type your message here..."  />
            <span class="input-group-btn">
              <button class="btn btn-primary" @click.prevent="sendMsg()"> Send </button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="gif" v-else>
      <div class="card">
        <div class="card-header text-center myrow">
          <strong> Chat with Support </strong> 
        </div>
          <div class="card-body">
          <img src="/frontend/assets/images/preview.gif" alt="userImg" />
          </div>
          <div class="card-footer">
            <div class="input-group">
              <input id="btn-input" type="text" v-model="msg" class="form-control input-sm" placeholder="Type your message here..."  />
              <span class="input-group-btn">
                <button class="btn btn-primary" @click.prevent="sendMsg()"> Send </button>
              </span>
            </div>
          </div>
      </div>
    </div>
    
  </div>
  </div>
</template>

<script>
 import moment from "moment";
export default {
  data() {
    return {
      allmessages: {},
      msg: "",
      moment: moment,
    };
  },

  created() {

    setInterval(() => {
      this.userMessage();
    }, 2000);
  },

  methods: {
    //get All Messages
    userMessage() {
      axios.get("/user/user-messages/")
        .then((res) => {
          this.allmessages = res.data;
        })
        .catch((err) => {});
    },

    sendMsg() {
      axios.post("/user/message-send", {
          msg: this.msg,
        })
        .then((res) => {
          this.msg = "";
          this.userMessage();
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
        });
    },
  },
};
</script>


<style>
p{
  font-weight: 550;
}
.gif img {
  width: 100%;
}
.username {
  color: #000;
}

.myrow {
  background: #f3f3f3;
  padding: 25px;
}

.myUser {
  padding-top: 30px;
  overflow-y: scroll;
  height: 450px;
  background: #f2f6fa;
}
.user li {
  list-style: none;
  margin-top: 20px;
}

.user li a:hover {
  text-decoration: none;
  color: red;
}
.userImg {
  height: 35px;
  border-radius: 50%;
}
.chat {
  list-style: none;
  margin: 0;
  padding: 0;
}

.chat li {
  margin-bottom: 40px;
  padding-bottom: 15px;
  margin-top: 20px;
  width: 80%;
  height: 10px;
}

.chat li .chat-body p {
  margin: 0;
}

.chat-msg {
  overflow-y: scroll;
  height: 500px;
  background: #f2f6fa;
}
.chat-msg .chat-img {
  width: 50px;
  height: 50px;
}
.chat-msg .img-circle {
  border-radius: 50%;
}
.chat-msg .chat-img {
  display: inline-block;
}
.chat-msg .chat-body {
  display: inline-block;
  max-width: 80%;
  background-color: lightblue;
  border-radius: 12.5px;
  padding: 15px;
}
.chat-msg .chat-body2 {
  display: inline-block;
  max-width: 80%;
  background-color: #ccc;
  border-radius: 12.5px;
  padding: 15px;
}
.chat-msg .chat-body strong {
  color: #0169da;
}

.chat-msg .buyer {
  text-align: right;
  float: right;
}
.chat-msg .buyer p {
  text-align: left;
}
.chat-msg .sender {
  text-align: left;
  float: left;
}
.chat-msg .left {
  float: left;
}
.chat-msg .right {
  float: right;
}

.clearfix {
  clear: both;
}
</style>