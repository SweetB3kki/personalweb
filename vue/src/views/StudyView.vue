<template>
  <div class="study-layout">
    <WindowFrame title="Сводка по учёбе" :icon="profile.mark">
      <div class="study-summary">
        <article class="study-summary__card">
          <span class="pixel-text">Дисциплин</span>
          <strong>{{ studySubjects.length }}</strong>
        </article>
        <article class="study-summary__card">
          <span class="pixel-text">Самая объёмная</span>
          <strong>Высшая математика</strong>
        </article>
        <article class="study-summary__card">
          <span class="pixel-text">Фокус</span>
          <strong>Математика, программирование, физика</strong>
        </article>
      </div>
    </WindowFrame>

    <WindowFrame title="Учебный план" :icon="profile.logo" flush>
      <div class="study-table-wrap scrollbar-win">
        <table class="study-table">
          <thead class="pixel-text">
            <tr>
              <th>№</th>
              <th>Дисциплина</th>
              <th>Кафедра</th>
              <th>Всего</th>
              <th>Ауд</th>
              <th>Лк</th>
              <th>Лб</th>
              <th>Пр</th>
              <th>СРС</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(subject, index) in studySubjects" :key="subject.name">
              <td>{{ index + 1 }}</td>
              <td>{{ subject.name }}</td>
              <td>{{ subject.department }}</td>
              <td>{{ subject.totalHours }}</td>
              <td>{{ subject.aud }}</td>
              <td>{{ subject.lecture }}</td>
              <td>{{ subject.lab }}</td>
              <td>{{ subject.practice }}</td>
              <td>{{ subject.srs }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </WindowFrame>
  </div>
</template>

<script>
import WindowFrame from '@/components/ui/WindowFrame.vue';
import { profile, studySubjects } from '@/data/siteContent';

export default {
  name: 'StudyView',
  components: {
    WindowFrame,
  },
  data() {
    return {
      profile,
      studySubjects,
    };
  },
};
</script>

<style scoped>
.study-layout {
  display: grid;
  gap: 1.2rem;
}

.study-summary {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 0.9rem;
}

.study-summary__card {
  display: grid;
  gap: 0.45rem;
  padding: 0.9rem;
  border: 2px solid #b9b9b9;
  border-right-color: #f5f5f5;
  border-bottom-color: #f5f5f5;
  background: rgba(255, 255, 255, 0.82);
}

.study-summary__card span {
  color: #27479b;
}

.study-summary__card strong {
  font-size: 1.25rem;
  line-height: 1.3;
}

.study-table-wrap {
  overflow: auto;
  max-height: 66vh;
}

.study-table {
  width: 100%;
  border-collapse: collapse;
  min-width: 900px;
}

.study-table th,
.study-table td {
  padding: 0.65rem 0.75rem;
  border: 1px solid #787878;
  text-align: left;
  font-size: 1.15rem;
}

.study-table thead {
  position: sticky;
  top: 0;
  z-index: 1;
}

.study-table th {
  color: #fff;
  background: linear-gradient(90deg, var(--desktop-blue), var(--desktop-blue-light));
}

.study-table tr:nth-child(even) td {
  background: rgba(255, 255, 255, 0.78);
}

.study-table tr:nth-child(odd) td {
  background: rgba(241, 241, 241, 0.88);
}

@media (max-width: 880px) {
  .study-summary {
    grid-template-columns: 1fr;
  }
}
</style>
