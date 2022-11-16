<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                <Link
                    class="text-indigo-400 hover:text-indigo-600"
                    :href="route('pedidos-itens.index')"
                    >PedidosItens
                </Link>
                <span class="text-indigo-400 font-medium">/</span>
                Visualizar PedidosIten
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
                            <p class="text-gray-600">Id Pedidos</p>
                            <p>
                                {{ pedido }}
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
                            <p class="text-gray-600">Peso Medio Peca</p>
                            <p>
                                {{ pedidosIten.peso_medio_peca }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600">Valor</p>
                            <p>
                                {{ pedidosIten.valor }}
                            </p>
                        </div>
                    </div>
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
                            <p class="text-gray-600">Descricao</p>
                            <p>
                                {{ pedidosIten.descricao }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600">Quantidade</p>
                            <p>
                                {{ pedidosIten.quantidade }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600">Produto Clientes</p>
                            <p>
                                {{ pedidosIten.produto_clientes }}
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
    props: ["pedidosIten","pedido","servico","status"],
};
</script>
