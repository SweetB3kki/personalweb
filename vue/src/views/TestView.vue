<template>
  <div class="test-layout">
    <WindowFrame title="Инструкция" :icon="profile.mark">
      <div class="instruction-block">
        <p>{{ testMeta.intro }}</p>
        <ol>
          <li v-for="question in testMeta.questions" :key="question">{{ question }}</li>
        </ol>
      </div>
    </WindowFrame>

    <WindowFrame title="PhysicsForm.exe" :icon="profile.mark">
      <form class="test-form" @submit.prevent="submitTest">
        <label class="test-form__field">
          <span class="pixel-text">Фамилия Имя Отчество</span>
          <input v-model.trim="formData.fio" type="text" required placeholder="Введите ваше ФИО" />
        </label>

        <label class="test-form__field">
          <span class="pixel-text">Группа</span>
          <select v-model="formData.group" required>
            <option disabled value="">Выберите группу</option>
            <optgroup v-for="(items, label) in testMeta.groups" :key="label" :label="label">
              <option v-for="group in items" :key="group" :value="group">{{ group }}</option>
            </optgroup>
          </select>
        </label>

        <label class="test-form__field">
          <span class="pixel-text">Вопрос 1</span>
          <textarea
            v-model.trim="formData.question1"
            rows="4"
            required
            placeholder="Введите формулу второго закона Ньютона"
          ></textarea>
        </label>

        <label class="test-form__field">
          <span class="pixel-text">Вопрос 2</span>
          <select v-model="formData.question2" required>
            <option disabled value="">Выберите ответ</option>
            <option value="Ньютон">Ньютон</option>
            <option value="Джоуль">Джоуль</option>
            <option value="Ватт">Ватт</option>
          </select>
        </label>

        <fieldset class="test-form__field">
          <legend class="pixel-text">Вопрос 3</legend>
          <label class="test-form__check">
            <input v-model="formData.question3" type="checkbox" value="Скорость измеряется в м/с" />
            Скорость измеряется в м/с
          </label>
          <label class="test-form__check">
            <input v-model="formData.question3" type="checkbox" value="Сила измеряется в джоулях" />
            Сила измеряется в джоулях
          </label>
          <label class="test-form__check">
            <input v-model="formData.question3" type="checkbox" value="Масса измеряется в килограммах" />
            Масса измеряется в килограммах
          </label>
        </fieldset>

        <div class="test-form__actions">
          <RetroButton @click="submitTest">Отправить</RetroButton>
          <RetroButton @click="clearForm">Очистить</RetroButton>
        </div>
      </form>
    </WindowFrame>
  </div>
</template>

<script>
import RetroButton from '@/components/ui/RetroButton.vue';
import WindowFrame from '@/components/ui/WindowFrame.vue';
import { profile, testMeta } from '@/data/siteContent';

const getInitialState = () => ({
  fio: '',
  group: '',
  question1: '',
  question2: '',
  question3: [],
});

export default {
  name: 'TestView',
  components: {
    RetroButton,
    WindowFrame,
  },
  data() {
    return {
      formData: getInitialState(),
      profile,
      testMeta,
    };
  },
  methods: {
    clearForm() {
      this.formData = getInitialState();
    },
    submitTest() {
      if (!this.formData.fio || !this.formData.group || !this.formData.question1 || !this.formData.question2) {
        return;
      }

      const body = [
        `ФИО: ${this.formData.fio}`,
        `Группа: ${this.formData.group}`,
        `Ответ 1: ${this.formData.question1}`,
        `Ответ 2: ${this.formData.question2}`,
        `Ответ 3: ${this.formData.question3.join(', ') || 'нет ответа'}`,
      ].join('\n');

      window.location.href = `mailto:${this.profile.email}?subject=${encodeURIComponent(
        this.testMeta.subject,
      )}&body=${encodeURIComponent(body)}`;
    },
  },
};
</script>

<style scoped>
.test-layout {
  display: grid;
  grid-template-columns: 360px minmax(0, 1fr);
  gap: 1.2rem;
  align-items: start;
}

.instruction-block p,
.instruction-block li,
.test-form__check {
  font-size: 1.2rem;
  line-height: 1.35;
}

.instruction-block p {
  margin: 0 0 1rem;
}

.instruction-block ol {
  margin: 0;
  padding-left: 1.3rem;
}

.test-form {
  display: grid;
  gap: 1rem;
}

.test-form__field {
  display: grid;
  gap: 0.45rem;
}

.test-form__field input[type='text'],
.test-form__field select,
.test-form__field textarea {
  width: 100%;
  padding: 0.65rem 0.8rem;
  border: 2px solid #7a7a7a;
  border-top-color: #9c9c9c;
  border-left-color: #9c9c9c;
  background: rgba(255, 255, 255, 0.92);
}

.test-form__field legend {
  margin-bottom: 0.35rem;
}

.test-form__check {
  display: flex;
  gap: 0.6rem;
  align-items: flex-start;
  justify-content: flex-start;
}

.test-form__check input {
  flex: 0 0 auto;
  width: auto;
  margin: 0.15rem 0 0;
}

.test-form__actions {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
}

@media (max-width: 960px) {
  .test-layout {
    grid-template-columns: 1fr;
  }
}
</style>
