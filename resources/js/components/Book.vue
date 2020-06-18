<template>

    <div>
        <div class="row">
            <div class="col-sm-12 col-lg-9 col-md-8">
                <div class="row">
                    <div class="col-sm-12 col-lg-2 col-md-12 ml-lg-2 justify-content-center">
                        <div>
                            <img :src="this.book.cover_image" >
                            <hr>
                            <p class="text-center"></p>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-5 col-md-12">
                        <div class="row">
                            <div class="col-sm-4 col-md-5 co-lg-6">
                                <hr>
                                <p>Author:</p>
                                <hr>
                                <p>Year Of Publication:</p>
                                <hr>
                                <p>Faculty:</p>
                                <hr>
                                <p>Department:</p>
                                <hr>
                            </div>

                            <div class="col-sm-4 col-md-5 co-lg-6">
                                <hr>
                                <p>{{book.author}}</p>
                                <hr>
                                <p>{{book.year_of_publication | myDate}}</p>
                                <hr>
                                <p>{{bookData.faculty}}</p>
                                <hr>
                                <p>{{bookData.department}}</p>
                                <hr>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-sm-5 col-md-6 col-lg-6">
                                <hr>
                                <p>Reviews <span class="mdi mdi-pen"></span>:</p>
                                <hr>
                                <p>Likes <span class="mdi mdi-thumb-up text-primary"></span>:</p>
                                <hr>
                                <p>Unlikes <span class="mdi mdi-thumb-down text-danger"></span>:</p>
                                <hr>
                            </div>

                            <div class="col-sm-5 col-md-6 col-lg-6">
                                <hr>
                                <p>{{book.reviews_count}}</p>
                                <hr>
                                <p>{{bookData.likes}}</p>
                                <hr>
                                <p>{{bookData.unlikes}}</p>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <a class="btn btn-success mx-2" v-bind:href="'/open-book/' + book.id" target="_blank"><span class="mdi mdi-book-open"></span> Open</a>


                    <a v-if="bookData.review !== null && bookData.review.like === 1" class="btn btn-primary mx-2" href="#" data-toggle="modal" data-target="#likeEditReviewModal"><span class="mdi mdi-thumb-down text-danger"></span> Review/Unlike</a>

                    <a v-if="bookData.review !== null && bookData.review.like === 0" class="btn btn-danger mx-2" href="#" data-toggle="modal" data-target="#likeEditReviewModal"><span class="mdi mdi-thumb-up text-primary"></span> Review/Like</a>

                    <a v-if="bookData.review === null" class="btn btn-primary mx-2" href="#" data-toggle="modal" data-target="#createReviewModal"><span class="mdi mdi-thumb-up"></span> Review/Like</a>


                </div>
            </div>

            <div class="col-sm-12 col-lg-3 col-md-4">
                <p class="text-blueCrest">Comments</p>
                <div class="my-3 container" id="">
                     <div class="panel-block">
                         <div v-for="comment in comments" class="card mb-2" style="border: 1px solid grey; border-radius: 10px; font-size: x-small" v-bind:key="comment.id">
                            <p class="p-2"><b>{{comment.user.name}}</b></p>
                            <div class="text-center" style="font-size: 15px">{{comment.comment}}</div>
                           <div class="p-2 text-danger">Last Update: {{comment.updated_at}}</div>
                         </div>

                    </div>
                </div>
            </div>
            <!--end of comments-->
        </div>



        <!--Modals start-->
        <div class="modal fade bd-example-modal-sm" id="createReviewModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <!--{!! Form::open(['action' => 'ReviewsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','files'=>'true']) !!}-->

                <form @submit.prevent="postComment" ref="newForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Review This Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body formBox">

                    <div class="row justify-content-center">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input v-model="newForm.like" type="radio" id="customRadioInline1" name="like" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="customRadioInline1"><span class="mdi mdi-thumb-up text-primary"></span></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input v-model="newForm.like" type="radio" id="customRadioInline2" name="like" class="custom-control-input" value="0">
                            <label class="custom-control-label" for="customRadioInline2"><span class="mdi mdi-thumb-down text-danger"></span></label>
                        </div>
                    </div>


                    <div class="form-group">

                        <textarea v-model="newForm.comment" type="text" name="comment" parsley-trigger="change" required
                                  placeholder="Comment" class="form-control" id="newcomment" rows="3"></textarea>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>

                </form>
            </div>
        </div>
    </div>

        <div v-if="bookData.review !== null" class="modal fade bd-example-modal-sm" id="likeEditReviewModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <!--{!! Form::open(['action' => ['ReviewsController@update', $review->id], 'method' => 'POST', 'enctype' => 'multipart/form-data','files'=>'true']) !!}-->

                    <form @submit.prevent="editComment" ref="editForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="likeModalLabel">Review This Book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body formBox">

                        <div class="row justify-content-center">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input v-model="editForm.like" type="radio" id="customRadioInline3" name="like" class="custom-control-input" value="1">
                                <label class="custom-control-label" for="customRadioInline3"><span class="mdi mdi-thumb-up text-primary"></span></label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input v-model="editForm.like" type="radio" id="customRadioInline4" name="like" class="custom-control-input" value="0">
                                <label class="custom-control-label" for="customRadioInline4"><span class="mdi mdi-thumb-down text-danger"></span></label>
                            </div>
                        </div>


                        <div class="form-group">

                        <textarea v-model="editForm.comment" type="text" name="comment" parsley-trigger="change" required
                                  placeholder="Comment" class="form-control" id="comment" rows="3"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Modals end-->
    </div>
</template>

<script>
    export default {
        name: 'book',
        props:['book'],
        data(){
            return{

                bookId:'',
                bookData:{},
                reviewId:'',
                comments:{},
                newForm: new Form({
                    book_id: '',
                    user_id: this.$userId,
                    like: '',
                    comment: '',
                }),

                editForm: new Form({
                    book_id: '',
                    user_id: this.$userId,
                    like: '',
                    comment: '',
                }),
            };
        },
        methods:{
            /*getBook(){
                this.loading = true;
                axios
                    .get('/fetch-book/'+ this.book.id)
                    .then(response => {
                        this.loading = false;
                        this.book = response.data;

                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },*/

            getdata(){
                this.loading = true;
                axios
                    .get('/fetch-book/'+ this.book.id + '/edit')
                    .then(response => {
                        this.loading = false;
                        this.bookData = response.data;
                        this.editForm.fill(this.bookData.review);
                        this.reviewId = this.bookData.review.id;

                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },

            postComment(){

                this.newForm.post('/book/review')
                    .then((response) => {
                        $('#createReviewModal').modal('hide');
                       if(response.data === 'success'){
                           //this.comments.push(this.newForm);
                           /*Fire.$emit('profileUpdate');*/
                       }


                    })
                    .catch((error) => {
                        console.log(error.message);
                    });
            },
            editComment(){

                this.editForm.put('/book/review/'+this.reviewId)
                    .then((response) => {
                        $('#likeEditReviewModal').modal('hide');
                       if(response.data === 'success'){
                           /*Fire.$emit('profileUpdate');*/
                       }

                    })
                    .catch((error) => {
                        console.log(error.message);
                    });
            },
            getComment(){
                this.loading = true;
                axios
                    .get('/book/comments/'+ this.book.id)
                    .then(response => {
                        this.loading = false;
                        this.comments = response.data;

                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },

        },
        created(){
            let path = this.$route.path;
            let res = path.split('/');
            this.bookId = res[res.length - 1];
            this.newForm.book_id = this.bookId;
            this.getdata();
            this.getComment();





        },
        mounted() {
            Echo.private(`review.${this.book.id}`)
                .listen('BroadcastComment', (e) => {
                    this.getComment();
                    this.getdata();
                })
        }
    }
</script>
