<template>
  <div class="container d-flex items-center justify-center text-center">
    <div class="row h-100 w-100">
      <div class="col-sm-12 align-self-center">
        <div
          class="p-5 dark-green-border bg-green"
          @dragover="dragover"
          @dragleave="dragleave"
          @drop="drop"
        >
          <form action="/csv" method="post" enctype="multipart/form-data" ref="form">
            <input type="hidden" name="_token" :value="csrf" />
            <input
              type="file"
              name="csvfile"
              id="assetsFieldHandle"
              class="d-none"
              @change="onFileChange"
              ref="file"
              accept=".txt, .csv"
            />
          </form>

          <label for="assetsFieldHandle" class="block cursor-pointer">
            <div>
              Drop CSV files here or
              <span class="btn btn-primary">Upload Files</span>
            </div>
          </label>
          <ul class="mt-4 list-group" v-if="this.csvFile" v-cloak>
            <li class="list-group-item text-sm p-1">
              @{{ csvFile.name }}
              <button
                class="btn btn-sm btn-danger"
                type="button"
                @click="removeFile(csvFile)"
                title="Remove file"
              >x</button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      csvFile: null,
    };
  },
  methods: {
    onFileChange() {
      let file = this.$refs.file.files;
      let filesize = file[0].size / 1024 / 1024;
      if (!file.length || filesize > 15) return;
      this.csvFile = file[0];
      this.$bvModal.show("#modal-center");
      this.$refs.form.submit();
    },
    removeFile(i) {
      this.csvFile = null;
    },
    dragover(event) {
      event.preventDefault();
      // Add some visual fluff to show the user can drop its files
      if (!event.currentTarget.classList.contains("bg-darkblue")) {
        event.currentTarget.classList.remove("bg-green");
        event.currentTarget.classList.add("bg-darkblue");
      }
    },
    dragleave(event) {
      // Clean up
      event.currentTarget.classList.add("bg-green");
      event.currentTarget.classList.remove("bg-darkblue");
    },
    drop(event) {
      event.preventDefault();
      this.$refs.file.files = event.target.files || event.dataTransfer.files;
      // Trigger the onChange event manually
      this.onFileChange();
      // Clean up
      event.currentTarget.classList.add("bg-green");
      event.currentTarget.classList.remove("bg-darkblue");
    },
  },
};
</script>
