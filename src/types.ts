export type GameState = 'home' | 'board' | 'question' | 'final-jeopardy' | 'winner';

export type Category = 'History' | 'Science' | 'Pop Culture' | 'Grammar' | 'Geography' | 'Comp Sci';

export interface Question {
  category: Category;
  value: number;
  question: string;
  answer: string;
}

export interface Team {
  id: number;
  name: string;
  score: number;
}
