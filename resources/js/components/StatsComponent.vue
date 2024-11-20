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

        <div class="row">
            
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
                        <p class="text-danger" v-show="error_message">{{error_message}}</p>
                    </div>

                    <div v-if="recorded" class="alert alert-success d-flex justify-content-between fade show" role="alert">
                        <div>Weight recorded successfully</div>
                        <div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-on:click="closeModal()">Close</button>
                    <button type="button" class="btn btn-primary" :disabled="!weight" v-on:click="recordWeight()">Record weight</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Recerdings weight -->
        <div class="modal fade" id="recordingsModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="recordingModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-muted" id="recordingModalLabel">Weight recordings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" v-on:click="closeModal()"></button>
                </div>

                <div class="modal-body">
                    <table class="table text-muted">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col" class="text-end">Weight</th>
                            <th scope="col" class="text-end">Gain/Loss</th>
                            <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="wt in weights">
                                <th scope="row">{{wt.id}}</th>
                                <td class="text-end">{{wt.weight}}</td>

                                <!---Weight changes-->
                                <td v-if="wt.weight_gain_status == true" class="text-danger text-end">+{{wt.display_stat}}</td>
                                <td v-else-if="wt.weight_gain_status == false" class="text-success text-end"> {{wt.display_stat}}</td>
                                <td v-else class="text-primary text-end">{{wt.display_stat}}</td>

                                <td>{{wt.created_at}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-on:click="closeModal()">Close</button>
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
                error_length:0,
                recorded:false,
                error_message:null,
            }
        },
        computed:{
            arrange(){
                let arr = this.weights;
                
                return arr.slice().sort(function(a, b) {
                    return a.weight - b.weight;
                });
            }
        },
        mounted() {
            this.loadData()
        },
        methods:{
            loadData(){
                this.error_message = null
                axios.get('api/getWeight').then((response=>{
                    this.user = response.data.user
                    this.weights = response.data.weight_recordings
                    this.quick_stats = response.data.quick_stats
                })).catch((error=>{
                    console.log("Error encountered")
                }))
            },
            closeModal(){
                this.error_message = null
                this.weight = null;
                this.recorded  = false
                //$('#exampleModal').modal('hide')
            },
            recordWeight(){
                this.error_message = null
                axios.post('api/postWeight',{weight : this.weight}).then((reponse=>{
                    this.recorded  = true
                    this.loadData()
                })).catch((error=>{
                    this.recorded  = false
                    if(error.response.status == 422){
                        this.post_errors = error.response.data

                        if(typeof this.post_errors == 'object'){
                            if(this.post_errors.weight){
                            }
                            this.error_message = this.post_errors.weight[0];
                        }
                    }
                }))
            }
        }
    }
</script>
