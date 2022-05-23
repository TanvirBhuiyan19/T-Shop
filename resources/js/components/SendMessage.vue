<template>
    <div class="container">
        <!-- Button trigger modal -->
          <h1 title="Send Message" data-toggle="modal" data-target="#sendMessage" style="cursor: pointer; color: blue; padding: 0px; margin: -5px;"><i class="fa fa-commenting"></i></h1>
        
        <!-- Modal -->
        <div class="modal fade" id="sendMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chat with Support about this Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal" style="margin-top:-20px;">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="sendMessage()">
              <div class="modal-body">
                  <div class="form-group">
                      <textarea class="form-control" id="id" v-model="form.msg" rows="6"></textarea>
                      <small class="text-danger" v-if="errors.msg">{{ errors.msg[0] }}</small>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Send Message</button>
              </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
    export default {

        mounted() {
            console.log('Component mounted.')
        },
        props: ['productId'],
        data(){
          return {
            form:{
              msg: ''
            },
            errors:{},
          }
        },
        methods:{
          sendMessage(){
            axios.post('/user/message-send/',{msg:this.form.msg, productId:this.productId} )
            .then((response) => {
                $('#closeModal').click();
                this.form.msg= '',  
                Toast.fire({
                  icon: 'success',
                    title: response.data,
                })
            })
            .catch(error => {
              this.errors = error.response.data.errors
              Toast.fire({
                icon: 'error',
                title: 'Invalid Credentials !!'
              })
            })
          }


        }


    }
</script>

<style>
    .modal-backdrop{
        position:relative;
    }
</style>
