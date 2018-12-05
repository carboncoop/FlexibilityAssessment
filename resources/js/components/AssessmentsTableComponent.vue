<template>
    <table class="table">
        <th>Name</th><th>Description</th><th>Author</th><th>Modified</th><th></th>
        <tr v-for="assessment in assessments">
            <td v-text="assessment.name"></td>
            <td v-text="assessment.description"></td>
            <td></td>
            <td v-text="assessment.updated_at"></td>
            <td></td>
        </tr>
    </table>
</template>

<script>
    export default {
        props: {'assessments': Array},
        mounted: function () {
        }
    }
</script>
