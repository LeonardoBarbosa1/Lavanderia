<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                <Link
                    class="text-indigo-400 hover:text-indigo-600"
                    :href="route('clientes.index')"
                    >Clientes
                </Link>
                <span class="text-indigo-400 font-medium">/</span>
                Visualizar Cliente
            </h2>
        </template>

        <div class="py-12">
            <div class="min-h-screen flex items-start justify-center px-4">
                <div class="max-w-4xl bg-white w-full rounded-lg shadow-xl">
                    <div class="p-4 border-b">
                        <h2 class="text-2xl">Detalhes</h2>
                    </div>

                    <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600">Nome</p>
                            <p>
                                {{ cliente.nome }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600">Cidade</p>
                            <p>
                                {{ cidade }}
                            </p>
                        </div>
                    </div>
                    <!--<div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600">Created By</p>
                            <p>
                                {{ cliente.created_by }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600">Updated By</p>
                            <p>
                                {{ cliente.updated_by }}
                            </p>
                        </div>
                    </div>-->
                    <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600">Status</p>
                            <p>
                                {{ status }}
                            </p>
                        </div>
                    </div>
                    
                    <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600">Cpf Cnpj</p>
                            <p>
                                {{ cliente.cpf_cnpj }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600">Telefone</p>
                            <p>
                                {{ cliente.telefone }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600">Endereco</p>
                            <p>
                                {{ cliente.endereco }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600">Bairro</p>
                            <p>
                                {{ cliente.bairro }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        AppLayout,
        Link,
    },
    props: ["cliente","cidade","status"],
};
</script>
