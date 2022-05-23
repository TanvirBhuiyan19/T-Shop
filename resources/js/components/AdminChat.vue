<template>
  <div class="row row-sm">
    <div class="col-md-3 myUser">
      <ul class="user">
        <strong>Chat List</strong>
        <hr />
        <strong v-if="users == ''" class="text-danger">No Users Found..!</strong>
        <li v-for="(user, index) in users" :key="index" class="text-left">
          <a href="" @click.prevent="userMessage(user.id)">
              <img :src="'/frontend/assets/images/users/' + user.image" class="userImg" alt="userImg" />
            <span class="username text-center">{{ user.name }}</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="col-md-9" v-if="allmessages.user">
      <div class="card">
        <div class="card-header text-center myrow">
          <strong> {{ allmessages.user.name }} </strong> 
        </div>
        <div class="card-body chat-msg" v-chat-scroll>
          <ul class="chat" v-for="(msg, index) in allmessages.messages" :key="index">
            <!-- User Part -->
            <li class="sender clearfix" v-if="allmessages.user.id === msg.sender_id" style="padding: 15px 0px">
              <span class="chat-img left clearfix mx-2">
                <img :src="'/frontend/assets/images/users/' + msg.user.image" class="userImg" alt="userImg" />
              </span>
              <div class="chat-body2 clearfix">
                <div class="header clearfix">
                  <strong class="primary-font">{{ msg.user.name }}</strong>
                  <small class="right text-muted">
                    ({{ moment(msg.created_at).fromNow() }})
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
                <img :src="'/admin/img/admins/' + msg.user.image" class="userImg" alt="userImg" />
              </span>
              <div class="chat-body clearfix">
                <div class="header clearfix">
                  <small class="left text-muted">
                    {{  moment(msg.created_at).fromNow() }}
                  </small>
                  <strong class="right primary-font"> {{ msg.user.name}}</strong> 
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
            <input id="btn-input" type="text" v-model="msg" class="form-control input-sm" placeholder="Type your message here..." />
            <span class="input-group-btn">
              <button class="btn btn-primary" @click.prevent="sendMsg()">
                Send
              </button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-9 gif" v-else>
      <img src="/frontend/assets/images/preview.gif" alt="userImg" />
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  data() {
    return {
      users: {},
      allmessages: {},
      selectedUser: '',
      msg: "",
      moment: moment,
    };
  },

  created() {
    this.getAllUsers();
    
        setInterval(() => {
        this.userMessage(this.selectedUser);
        }, 2000);
    
  },

  methods: {
    //get all users
    getAllUsers() {
      axios.get("/admin/user-all")
        .then((res) => {
          this.users = res.data;
        })
        .catch((err) => {});
    },

    //get Seldcted Users messages
    userMessage(userId) {
      axios.get("/admin/user-messages/" + userId)
        .then((res) => {
          this.allmessages = res.data;
          this.selectedUser = userId;
        })
        .catch((err) => {});
    },

    sendMsg() {
      axios
        .post("/admin/send-message", {
          receiver_id: this.selectedUser,
          msg: this.msg,
        })
        .then((res) => {
          this.msg = "";
          this.userMessage(this.selectedUser);
          console.log(res.data);
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
        });
    },
  },
};
</script>
<style>
.gif img {
  /* width: 750px; */
  height: 550px;
}
p{
    font-weight: 400;
    color: #000;
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
  height: 550px;
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
  padding-bottom: 5px;
  margin-top: 30px;
  width: 80%;
  height: 10px;
}

.chat li .chat-body p {
  margin: 0;
}

.chat-msg {
  overflow-y: scroll;
  height: 415px;
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
