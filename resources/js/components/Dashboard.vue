<template>
    <div>
        <h1>Баланс: {{ balance }}</h1>
        <ul>
            <li v-for="transaction in transactions" :key="transaction.id">
                {{ transaction.created_at }} - {{ transaction.description }} - {{ transaction.amount }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            balance: 0,
            transactions: [],
        };
    },
    mounted() {
        this.fetchData();
        setInterval(this.fetchData, 5000); // обновление каждые 5 секунд
    },
    methods: {
        fetchData() {
            axios.get('/api/balance')
                .then(response => {
                    this.balance = response.data.balance;
                    this.transactions = response.data.transactions;
                });
        },
    },
};
</script>
