import Vue from 'vue';

if (document.getElementById("jobs")) {
    const jobVue = new Vue({
        el: '#jobs',
        mounted: function () {
            if (document.getElementsByClassName("flash_msg") != null) {
                flashVue.$emit('showFlashMessage');
            }
            if ($("body").hasClass("rtl")) {
                this.reverse = true
            }
        },
        data: {
            reverse:false,
            refundable_user: '',
            refundable_payment_method: '',
            proposal: {
                amount: Vue.prototype.trans('lang.enter_proposal_amount'),
                deduction: '00.00',
                total: '00.00',
                completion_time: '',
                description: '',
                milestoneList: [],
            },
            //milestone
            menu: {     //milestone edit box
                parent_menu:'',
                custom_link:'',
                custom_title:'',
                count: 0
            },
            custom_links:[],  //milestone_list
            //milestone_end
            report: {
                reason: '',
                description: '',
                id: '',
                model: 'App\\Job',
                report_type: '',
            },
            form_errors: [],
            custom_error: false,
            loading: false,
            message: '',
            disable_btn: '',
            saved_class: '',
            heart_class: 'far fa-heart',
            text: Vue.prototype.trans('lang.click_to_save'),
            follow_text: Vue.prototype.trans('lang.click_to_follow'),
            disable_follow: '',
            start:0,
            end:1000,
            notificationSystem: {
                options: {
                    success: {
                        position: "topRight",
                        timeout: 3000
                    },
                    error: {
                        position: "topRight",
                        timeout: 4000
                    },
                    completed: {
                        position: 'center',
                        timeout: 1000,
                    },
                    info: {
                        overlay: true,
                        zindex: 999,
                        position: 'center',
                        timeout: 3000,
                        onClosing: function (instance, toast, closedBy) {
                            vmpostJob.showCompleted(Vue.prototype.trans('lang.process_cmplted_success'));
                        }
                    },
                    message: {
                        position: 'center',
                        timeout: 900,
                        progressBar: false
                    }
                }
            },
        },
        created: function() {
            var urlParams = new URLSearchParams(window.location.search)
            if (urlParams.get('minprice')) {
                var minprice = urlParams.get('minprice');
                this.start = minprice
            }
            if (urlParams.get('maxprice')) {
                var maxprice = urlParams.get('maxprice');
                this.end = maxprice
            }
        },
        methods: {
            onChange (value) {
                this.start = value[0]
                this.end = value[1]
            },
            showCompleted(message) {
                return this.$toast.success(' ', message, this.notificationSystem.options.completed);
            },
            showInfo(message) {
                return this.$toast.info(' ', message, this.notificationSystem.options.info);
            },
            showMessage(message) {
                return this.$toast.success(' ', message, this.notificationSystem.options.success);
            },
            showError(error) {
                return this.$toast.error(' ', error, this.notificationSystem.options.error);
            },
            add_wishlist: function (element_id, id, column, saved_text) {
                var self = this;
                axios.post(APP_URL + '/user/add-wishlist', {
                    id: id,
                    column: column,
                })
                    .then(function (response) {
                        if (response.data.authentication == true) {
                            if (column == 'saved_jobs') {
                                jQuery('#' + element_id).parents('li').addClass('wt-btndisbaled');
                                jQuery('#' + element_id).addClass('wt-clicksave');
                                jQuery('#' + element_id).find('.save_text').text(saved_text);
                                self.disable_btn = 'wt-btndisbaled wt-clicksave';
                                self.text = saved_text;
                                self.heart_class = 'fa fa-heart';
                            }
                            if (column == 'saved_employers') {
                                self.disable_follow = 'wt-btndisbaled';
                                self.follow_text = saved_text;
                            }
                            self.showMessage(response.data.message);
                        } else {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            check_auth: function (url) {
                var self = this;
                axios.get(APP_URL + '/check-proposal-auth-user')
                    .then(function (response) {
                        if (response.data.auth == 1) {
                            window.location.replace(url);
                        } else {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {

                    });
            },
            calculate_amount: function (commission) {
                console.log(commission);
                this.proposal.deduction = (this.proposal.amount / 100) * commission;
                this.proposal.total = this.proposal.amount - this.proposal.deduction;
            },
            addMilestone: function () {
                console.log("Add Milestone_vue00");
                if (this.menu.custom_title == '' || this.menu.custom_link == '') {
                    this.showError('empty field not allow');
                } else {
                    var custom_list_count = jQuery('.wt-btn').parents('.wt-skillsform').next('.milestone_list').find('ul#skill_list li').length;
                    custom_list_count = custom_list_count - 1;
                    this.menu.count = custom_list_count;
                    this.custom_links.push(Vue.util.extend({}, this.menu, this.menu.count++, this.menu.custom_title, this.menu.custom_link, this.menu.parent_menu))
                    this.menu = {  parent_menu:'', custom_link:'', custom_title:'', count: 0 }
                }
            },
            removeOrder: function (index) {
                console.log("remove milestone",index);
                var self = this;
                this.$swal({
                    title: "Delete Milestone",
                    text: "Are you Sure?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    showLoaderOnConfirm: true
                }).then((result) => {
                    var self = this;
                    if(result.value) {
                        self.custom_links.splice(index, 1);
                        self.$swal('Deleted', 'The Milestone Was Deleted', 'success');
                    } else {
                        this.$swal.close()
                    }
                })
            },
            submitJobProposal: function (id, user_id) {
                this.loading = true;
                this.custom_error = false;
                let propsal_form = document.getElementById('send-propsal');
                let form_data = new FormData(propsal_form);
                form_data.append('id', id);
                form_data.append('user_id', user_id);
                form_data.append('milestones', this.custom_links);
                var self = this;
                axios.post(APP_URL + '/proposal/submit-proposal', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.loading = false;
                            self.showCompleted(response.data.message);
                            setTimeout(function () {
                                window.location.replace(APP_URL + '/freelancer/proposals');
                            }, 1050);
                        } else {
                            self.loading = false;
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        self.loading = false;
                        if (error.response.data.errors.amount) {
                            self.showError(error.response.data.errors.amount[0]);
                        }
                        if (error.response.data.errors.completion_time) {
                            self.showError(error.response.data.errors.completion_time[0]);
                        }
                        if (error.response.data.errors.description) {
                            self.showError(error.response.data.errors.description[0]);
                        }
                    });
            },
            submitReport: function (id, report_type) {
                this.report.report_type = report_type;
                this.report.id = id;
                var self = this;
                axios.post(APP_URL + '/submit-report', self.report)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.showMessage(response.data.message);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            if (error.response.data.errors.description) {
                                self.showError(error.response.data.errors.description[0]);
                            }
                            if (error.response.data.errors.reason) {
                                self.showError(error.response.data.errors.reason[0]);
                            }
                        }
                    });
            },
            hireFreelancer: function (id, mode) {
                this.$swal({
                    title: Vue.prototype.trans('lang.want_to_hire'),
                    type: "warning",
                    customContainerClass: 'hire_popup',
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        if (mode == 'false') {
                            axios.post(APP_URL + '/user/generate-order/bacs/'+id+'/job')
                                .then(function (response) {
                                    if (response.data.type == 'success') {
                                        window.location.replace(APP_URL+'/user/order/bacs/'+id+'/'+response.data.order_id+'/project');
                                    }
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                        } else {
                            window.location.replace(APP_URL + '/payment-process/' + id);
                        }
                    } else {
                        this.$swal.close()
                    }
                })
            },
            showCoverLetter: function (id) {
                var modal_ref = 'myModalRef-' + id;
                this.$refs[modal_ref].show();
            },
            showRefoundForm: function (id) {
                var modal_ref = 'myModalRef-' + id;
                this.$refs[modal_ref].show();
            },
            submitRefund: function (job_id) {
                this.loading = true;
                var self = this;
                var job_id = $('#refundable-job-id-'+job_id).val();
                var selected_user = $("#refundable_user_id-"+job_id).val();
                var refundable_amount = $('#refundable-amount-'+job_id).val();
                var order_id = $('#refundable-order-id-'+job_id).val();
                let form = document.getElementById('submit_refund_' + job_id);
                let form_data = new FormData(form);
                form_data.append('refundable_user_id', selected_user);
                form_data.append('amount', refundable_amount);
                form_data.append('order_id', order_id);
                form_data.append('job_id', job_id);
                form_data.append('type', 'job');
                axios.post(APP_URL + '/admin/submit-user-refund', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.loading = false;
                            self.showMessage(response.data.message);
                            window.location.replace(APP_URL + '/admin/jobs');
                        } else if (response.data.type == 'error') {
                            self.loading = false;
                            self.showError(response.data.message);
                        }
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            self.loading = false;
                            if (error.response.data.errors.payment_method) {
                                self.showError(error.response.data.errors.payment_method[0]);
                            }
                        }
                    });
            },
            downloadAttachments: function (form_id) {
                document.getElementById(form_id).submit();
            },
            jobStatus: function (id, proposal_id, cancel_text, confirm_button, validation_error, popup_title) {
                var job_status = document.getElementById("job_status");
                var status = job_status.options[job_status.selectedIndex].value;
                if (status == "cancelled") {
                    this.$swal({
                        title: popup_title,
                        text: cancel_text,
                        type: 'info',
                        input: 'textarea',
                        confirmButtonText: confirm_button,
                        showCancelButton: true,
                        showLoaderOnConfirm: true,
                        inputValidator: (textarea) => {
                            return new Promise((resolve) => {
                                if (textarea != '') {
                                    resolve()
                                } else {
                                    resolve(validation_error)
                                }
                            })
                        },
                        preConfirm: (textarea) => {
                            var self = this;
                            return axios.post(APP_URL + '/submit-report', {
                                reason: 'proposal cancel',
                                report_type: 'proposal_cancel',
                                description: textarea,
                                id: id,
                                model: 'App\\Job',
                                proposal_id: proposal_id
                            })
                                .then(function (response) {
                                    if (response.data.type == 'success') {
                                        self.showCompleted(response.data.message);
                                        setTimeout(function () {
                                            window.location.replace(APP_URL + '/employer/dashboard/manage-jobs');
                                        }, 1500);
                                    } else if (response.data.type == 'error') {
                                        self.showError(response.data.message);
                                    }
                                })
                                .catch(error => {
                                    if (error.response.status == 422) {
                                        if (error.response.data.errors.description) {
                                            self.$swal.showValidationMessage(
                                                error.response.data.errors.description[0]
                                            )
                                        }
                                    }
                                })
                        },
                        allowOutsideClick: () => !this.$swal.isLoading()
                    }).then((result) => { })
                }
                if (status == "completed") {
                    this.$refs.myModalRef.show()
                }
            },
            viewReason: function (description) {
                this.$swal({
                    width: 600,
                    padding: '3em',
                    text: description
                })
            },
            submitFeedback: function (id, job_id) {
                this.loading = true;
                let review_form = document.getElementById('submit-review-form');
                let form_data = new FormData(review_form);
                form_data.append('freelancer_id', id);
                form_data.append('job_id', job_id);
                var self = this;
                axios.post(APP_URL + '/user/submit-review', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.loading = false;
                            var message = response.data.message;
                            self.showMessage(message);
                            setTimeout(function () {
                                self.$refs.myModalRef.hide()
                                window.location.replace(APP_URL + '/employer/dashboard/manage-jobs');
                            }, 1000);
                        } else {
                            self.loading = false;
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            },
            submitDispute: function (id) {
                this.loading = true;
                let dispute_form = document.getElementById('dispute-form');
                let form_data = new FormData(dispute_form);
                form_data.append('proposal_id', id);
                var self = this;
                axios.post(APP_URL + '/freelancer/store-dispute', form_data)
                    .then(function (response) {
                        console.log(response.data);
                        if (response.data.type == 'success') {
                            self.loading = false;
                            var message = response.data.message;
                            self.showMessage(message);
                            setTimeout(function () {
                                window.location.replace(APP_URL + '/freelancer/dashboard');
                            }, 2000);
                        } if (response.data.type == 'error') {
                            self.loading = false;
                            self.showError(message);
                        }
                    })
                    .catch(function (error) {
                        self.loading = false;
                    });
            },
            deleteJob: function (id) {
                var self = this;
                this.$swal({
                    title: Vue.prototype.trans('lang.del_job'),
                    type: "warning",
                    customContainerClass: 'hire_popup',
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    var self = this;
                    if (result.value) {
                        axios.post(APP_URL + '/job/delete-job', {
                            job_id: id
                        })
                            .then(function (response) {
                                if (response.data.type == "success") {
                                    setTimeout(function () {
                                        self.$swal({
                                            title: this.title,
                                            text: Vue.prototype.trans('lang.job_deleted'),
                                            type: "success"
                                        })
                                        jQuery('.del-job-' + id).remove();
                                    }, 500);
                                } else {
                                    self.showError(response.data.message);
                                }
                            })
                    } else {
                        this.$swal.close()
                    }
                })
            },
        }
    });
}