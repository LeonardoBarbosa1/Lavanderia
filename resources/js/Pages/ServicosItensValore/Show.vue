<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                <Link
                    class="text-indigo-400 hover:text-indigo-600"
                    :href="route('servicos-itens-valores.index')"
                    >ServicosItensValores
                </Link>
                <span class="text-indigo-400 font-medium">/</span>
                Visualizar ServicosItensValore
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
                            <p class="text-gray-600">Valor</p>
                            <p>
                                {{ servicosItensValore.valor }}
                            </p>
                        </div>
                    </div>
                    
                    <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600">Id Servicos</p>
                            <p>
                                {{ servico }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600">Produto Utilizado</p>
                            <p>
                                {{ servicosItensValore.produto_utilizado }}
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
    props: ["servicosItensValore","servico"],
};
</script>
