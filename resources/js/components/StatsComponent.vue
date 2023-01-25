<template>

    <div class="container">
        
        <div class="row gx-5 mt-4">
            <h3 class="text-muted"> <strong>Welcome</strong> <span style="margin-left: 10px;" >{{user.name}}</span></h3>
        </div>
        
        <div class="row gx-5 mt-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted">Daily avarage</p>
                        {{quick_stats.daily}}
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted">Weekly avarage</p>
                        {{quick_stats.weekly}}
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-5 mt-5">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted">Monthly avarage</p>
                        {{quick_stats.monthly}}
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted">Yearly avarage</p>
                        {{quick_stats.yearly}}
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Record weekly weight</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" v-on:click="closeModal()"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="weeklyweight" class="form-label">Weight</label>
                        <input type="number" class="form-control" id="weeklyweight" placeholder="E.g 246" v-model="weight">
                        <p class="text-danger" v-show="false" >pakaipa</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-on:click="closeModal()">Close</button>
                    <button type="button" class="btn btn-primary" v-on:click="recordWeight()">Record weight</button>
                </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user:{},
                stats:[],
                weight:null,
                weights:[],
                quick_stats:{},
                post_errors:[],
                error_length:0
            }
        },
        mounted() {
            this.loadData()
        },
        methods:{
            loadData(){
                axios.get('api/getWeight').then((response=>{
                    this.user = response.data.user
                    this.weights = response.data.weight
                    this.quick_stats = response.data.quick_stats
                })).catch((error=>{
                    console.log("Error encountered")
                }))
            },
            closeModal(){
                this.weight = null;
            },
            recordWeight(){
                axios.post('api/postWeight',{weight : this.weight}).then((reponse=>{
                    
                })).catch((error=>{
                    if(error.response.status == 422){
                        this.post_errors = error.response.data

                        if(typeof this.post_errors == 'object'){
                            if(this.post_errors.weight){
                                console.log('iripo')
                            }
                            console.log(this.post_errors.weight[0])
                        }
                        
                        if(typeof this.post_errors == 'array'){
                            console.log('array wangu')
                        }
                    }
                }))
            }
        }
    }
</script>
