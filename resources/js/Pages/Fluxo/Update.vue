<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                <Link
                    class="text-indigo-400 hover:text-indigo-600"
                    :href="route('fluxos.index')"
                    >Fluxos
                </Link>
                <span class="text-indigo-400 font-medium">/</span>
                Editar Fluxo
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit" class="mb-6">
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7"
                        >
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Data Saida</label
                                >
                                <Datepicker id="data_saida" v-model="form.data_saida"
                                    :enableTimePicker="false"
                                    :allowedDates="escalas_dias"
                                    :locale="date-fns/locale/pt"
                                    :disabledWeekDays="disabled_weekdays"
                                     />
                                <p
                                    class="error text-red-700"
                                    v-if="errors.data_saida"
                                >
                                    {{ errors.data_saida }}
                                </p>
                            </div>
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Data Entrada</label
                                >
                                <Datepicker id="data_entrada" v-model="form.data_entrada"
                                    :enableTimePicker="false"
                                    :locale="date-fns/locale/pt"
                                    :disabledWeekDays="disabled_weekdays"
                                    :inputFormat=dd-mm-yyyy

                                />
                                <p
                                    class="error text-red-700"
                                    v-if="errors.data_entrada"
                                >
                                    {{ errors.data_entrada }}
                                </p>
                            </div>
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Status</label
                                >
                                <select id="status" v-model="form.status" name="status" class="
                                    py-2
                                    px-3
                                    rounded-lg
                                    border-2 border-purple-300
                                    mt-1
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-purple-600
                                    focus:border-transparent

                                ">

                                    <option v-for="statu in status" :key="statu.id" :value="statu.id">
                                        {{ statu.descricao }}
                                    </option>
                                    <p class="error text-red-700" v-if="errors.status">{{ errors.status }}</p>
                                </select>
                            </div>


                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Id Pedidos Itens</label
                                >
                                <select id="id_pedidos_itens" v-model="form.id_pedidos_itens" name="pedidosItens" class="
                                    py-2
                                    px-3
                                    rounded-lg
                                    border-2 border-purple-300
                                    mt-1
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-purple-600
                                    focus:border-transparent

                                ">

                                    <option v-for="pedidosIten in pedidosItens" :key="pedidosIten.id" :value="pedidosIten.id">
                                        {{ pedidosIten.id }}
                                    </option>
                                    <p class="error text-red-700" v-if="errors.id_pedidos_itens">{{ errors.id_pedidos_itens }}</p>
                                </select>
                            </div>
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Id Setores</label
                                >
                                <select id="id_setores" v-model="form.id_setores" name="setores" class="
                                    py-2
                                    px-3
                                    rounded-lg
                                    border-2 border-purple-300
                                    mt-1
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-purple-600
                                    focus:border-transparent

                                ">

                                    <option v-for="setore in setores" :key="setore.id" :value="setore.id">
                                        {{ setore.descricao }}
                                    </option>
                                    <p class="error text-red-700" v-if="errors.id_setores">{{ errors.id_setores }}</p>
                                </select>
                            </div>
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Quantidade</label
                                >
                                <input
                                    id="quantidade"
                                    v-model="form.quantidade"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    placeholder=""
                                />
                                <p
                                    class="error text-red-700"
                                    v-if="errors.quantidade"
                                >
                                    {{ errors.quantidade }}
                                </p>
                            </div>
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Observacao</label
                                >
                                <input
                                    id="observacao"
                                    v-model="form.observacao"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    placeholder=""
                                />
                                <p
                                    class="error text-red-700"
                                    v-if="errors.observacao"
                                >
                                    {{ errors.observacao }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex justify-end md:gap-8 gap-4 pt-5 pb-5 pr-5"
                        >
                            <Link
                                :href="route('fluxos.index')"
                                class="w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2"
                                type="button"
                            >
                                Cancelar
                            </Link>
                            <button
                                type="submit"
                                class="w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2"
                            >
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import { Link } from "@inertiajs/inertia-vue3";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

export default {
    components: {
        AppLayout,
        Datepicker,
        Link,
    },
    props: ["fluxo", "errors","setores","pedidosItens","status"],
    data() {
        return {
            form: {
                data_saida: this.$props.fluxo.data_saida,
                data_entrada: this.$props.fluxo.data_entrada,
                status: this.$props.fluxo.status,
                id_pedidos_itens: this.$props.fluxo.id_pedidos_itens,
                id_setores: this.$props.fluxo.id_setores,
                quantidade: this.$props.fluxo.quantidade,
                observacao: this.$props.fluxo.observacao,
            },
        };
    },
    methods: {
        submit() {
            this.$inertia.put(
                route("fluxos.update", this.$props.fluxo.id),
                this.form
            );
        },
    },
};
</script>
