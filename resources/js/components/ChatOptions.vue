<template>
    <div class="row mb-3">
        <div class="d-flex justify-content-end">
            <!-- New Chat -->
            <button
                type="button"
                class="btn btn-outline-primary me-3"
                data-bs-toggle="modal"
                data-bs-target="#newChatModal"
            >
                New Chat <i class="bi bi-chat"></i>
            </button>
            <!-- New Chat Modal -->
            <div
                class="modal fade"
                id="newChatModal"
                tabindex="-1"
                aria-labelledby="newChatModalLabel"
                aria-hidden="true"
                ref="newChatModalRef"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newChatModalLabel">
                                New Chat
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label
                                    for="newChatEmailInput"
                                    class="form-label"
                                >
                                    Email address
                                </label>
                                <input
                                    type="email"
                                    class="form-control"
                                    :class="{
                                        'is-invalid':
                                            errors?.email && newChatEmail,
                                    }"
                                    id="newChatEmailInput"
                                    placeholder="name@example.com"
                                    v-model="newChatEmail"
                                    @keydown.enter="newChat"
                                />
                                <div class="invalid-feedback">
                                    {{ errors?.email?.toString() }}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="newChat"
                                :disabled="!newChatEmail"
                            >
                                Invite <i class="bi bi-person-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of New Chat Modal -->
            <!-- End of New Chat -->

            <!-- New Group Chat -->
            <button
                type="button"
                class="btn btn-outline-primary"
                data-bs-toggle="modal"
                data-bs-target="#newGroupChatModal"
            >
                New Group <i class="bi bi-people"></i>
            </button>
            <!-- New Group Chat Modal -->
            <div
                class="modal fade"
                id="newGroupChatModal"
                tabindex="-1"
                aria-labelledby="newGroupChatModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newGroupChatModalLabel">
                                New Group Chat
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label
                                    for="newGroupChatNameInput"
                                    class="form-label"
                                >
                                    Name
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="newGroupChatNameInput"
                                    v-model="groupChatName"
                                    @keydown.enter=""
                                />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="addMembers"
                                :disabled="!groupChatName"
                            >
                                Create
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-person-add"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"
                                    />
                                    <path
                                        d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of New Group Chat Modal -->
            <!-- Add Members Modal -->
            <div
                class="modal fade"
                id="addMemberToGroupModal"
                tabindex="-1"
                aria-labelledby="addMemberToGroupModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5
                                class="modal-title"
                                id="addMemberToGroupModalLabel"
                            >
                                Add Member
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label
                                    for="newGroupMemberEmailInput"
                                    class="form-label"
                                >
                                    Email address
                                </label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="newGroupMemberEmailInput"
                                    placeholder="name@example.com"
                                    @keydown.enter=""
                                />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">
                                Invite <i class="bi bi-person-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Add Members Modal -->
            <!-- End of New Group Chat -->
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useToast } from 'vue-toastification'

// Get toast interface
const toast = useToast()

const newChatModalRef = ref(null)
const newChatEmail = ref("")

const errors = ref({})

const newChat = async () => {
    await axios
        .post(`/invite-to-chat`, {
            email: newChatEmail.value,
            invite_type: 'chat'
        })
        .then((res) => {
            newChatEmail.value = ""
            errors.value = null
            // newChatModalRef.value.classList.remove('show');
            // document.body.classList.remove('modal-open');
            // document.querySelector('.modal-backdrop').remove();
            toast.success(res.data.message, {
                timeout: 2500
            })
        })
        .catch((err) => {
            errors.value = err.response?.data?.errors
        })
};

const groupChatName = ref("")

const addMembers = () => {}
</script>

<style lang="scss" scoped>

</style>
