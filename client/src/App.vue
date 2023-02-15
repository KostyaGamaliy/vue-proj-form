<template>
  <div class="container">
    <div class="row">
      <form style="width: 100%" method="post" action="" class="">
        <div class="form-group row">
          <label for="title" class="col-md-2 col-form-label">Заголовок</label>
          <div class="col-md-10">
            <input
                type="text"
                class="form-control"
                :class="{'is-invalid': errors['title']}"
                id="title"
                name="title"
                v-model="title"
            >
            <div class="invalid-feedback">
              {{errors['title'] ? errors['title'] : ""}}
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="annotation" class="col-md-2 col-form-label">Аннотация</label>
          <div class="col-md-10">
                    <textarea
                        name="annotation"
                        id="annotation"
                        class="form-control"
                        :class="{'is-invalid': errors['annotation']}"
                        cols="30"
                        rows="10"
                        v-model="annotation"
                    ></textarea>
            <div class="invalid-feedback">
              {{errors['annotation'] ? errors['annotation'] : ""}}
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="content" class="col-md-2 col-form-label">Текст новости</label>
          <div class="col-md-10">
                    <textarea
                        name="content"
                        id="content"
                        class="form-control"
                        :class="{'is-invalid': errors['content']}"
                        cols="30"
                        rows="10"
                        v-model="content"
                    ></textarea>
            <div class="invalid-feedback">
              {{errors['content'] ? errors['content'] : ""}}
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="email" class="col-md-2 col-form-label">Email  автора для связи</label>
          <div class="col-md-10">
            <input
                type="email"
                class="form-control"
                :class="{'is-invalid': errors['email']}"
                id="email"
                name="email"
                v-model="email"
            >
            <div class="invalid-feedback">
              {{errors['email'] ? errors['email'] : ""}}
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="views" class="col-md-2 col-form-label">Кол-во просмотров</label>
          <div class="col-md-10">
            <input
                type="text"
                class="form-control"
                :class="{'is-invalid': errors['views']}"
                id="views"
                name="views"
                v-model="views"
            >
            <div class="invalid-feedback">
              {{errors['views'] ? errors['views'] : ""}}
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="date" class="col-md-2 col-form-label">Дата публикации</label>
          <div class="col-md-10">
            <input
                type="date"
                class="form-control"
                :class="{'is-invalid': errors['date']}"
                id="date"
                name="date"
                v-model="date"
            >
            <div class="invalid-feedback">
              {{errors['date'] ? errors['date'] : ""}}
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="is_publish" class="col-md-2 col-form-label">Публичная новость</label>
          <div class="col-md-10">
            <input
                type="checkbox"
                class="form-control form-check-input m-auto h-100 px-4"
                id="is_publish"
                name="is_publish"
                v-model="is_publish"
            />
            <div class="invalid-feedback"></div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-2 col-form-label">Публиковать на главной</label>
          <div class="col-md-10">
            <div class="form-check" :class="{'is-invalid': errors['publish_in_index']}">
              <input class="form-check-input" :class="{'is-invalid': errors['publish_in_index']}" type="radio" name="publish_in_index" id="publish_in_index_yes" value="yes" v-model="publish_in_index">
              <label class="form-check-label" for="publish_in_index_yes">
                Да
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" :class="{'is-invalid': errors['publish_in_index']}" type="radio" name="publish_in_index" id="publish_in_index_no" value="no" v-model="publish_in_index">
              <label class="form-check-label" for="publish_in_index_no">
                Нет
              </label>
            </div>
            <div class="invalid-feedback">
              {{errors['publish_in_index'] ? errors['publish_in_index'] : ""}}
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="category" class="col-md-2 col-form-label">Публичная новость</label>
          <div class="col-md-10">
            <select id="category" class="form-control" :class="{'is-invalid': errors['category']}" name="category" v-model="category">
              <option disabled selected>Выберете категорию из списка..</option>
              <option value="1">Спорт</option>
              <option value="2">Культура</option>
              <option value="3">Политика</option>
            </select>
            <div class="invalid-feedback">
              {{errors['category'] ? errors['category'] : ""}}
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-9">
            <button type="submit" class="btn btn-primary" @click.prevent="send()">Отправить</button>
          </div>
          <div class="col-md-3" v-if="isValid">
            <div class="alert alert-success">Форма валидна</div>
          </div>
          <div class="col-md-3" v-else-if="!isValid">
            <div class="alert alert-danger">Форма не валидна</div>
          </div>
        </div>
      </form>

    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: 'App',
  data() {
    return {
      isValid: null,
      title: null,
      annotation: null,
      content: null,
      email: null,
      views: null,
      date: null,
      is_publish: null,
      publish_in_index: null,
      category: null,
      errors: [],
    }
  },
  methods: {
    send() {
      axios.post('http://localhost:85/validator.php', this.getFormFields).then(response => {
        if (!response.data.errors) {
          this.errors = [];
          this.isValid = true;
        } else {
          this.errors = response.data.errors;
          this.isValid = false;
        }
      }).catch(error => {
        console.log(error);
      })
    },
  },
  computed: {
    getFormFields() {
      return {
        title: this.title,
        annotation: this.annotation,
        content: this.content,
        email: this.email,
        views: this.views,
        date: this.date,
        is_publish: this.is_publish,
        publish_in_index: this.publish_in_index,
        category: this.category
      }
    }
  }
}
</script>
