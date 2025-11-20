import { Question } from '../types';

export const questions: Question[] = [
  // History
  {
    category: 'History',
    value: 200,
    question: 'This U.S. document, signed in 1776, declared the American colonies independent from Britain.',
    answer: 'What is the Declaration of Independence?'
  },
  {
    category: 'History',
    value: 400,
    question: 'This 13th-century Italian explorer traveled to Asia and wrote about his experiences in a book that fascinated Europe.',
    answer: 'Who is Marco Polo?'
  },
  {
    category: 'History',
    value: 600,
    question: 'This 18th-century intellectual movement emphasized reason, individual rights, and skepticism of traditional authority, influencing revolutions in America and France.',
    answer: 'What is the Enlightenment?'
  },
  {
    category: 'History',
    value: 800,
    question: 'This economic system, dominant in Western Europe from the 9th to 15th centuries, was based on landholding, mutual obligations, and a hierarchy between lords and vassals.',
    answer: 'What is feudalism?'
  },
  {
    category: 'History',
    value: 1000,
    question: 'The Defenestration of Prague in 1618, where Protestant nobles threw Catholic officials from a window, sparked this major European conflict',
    answer: 'What is the Thirty Years War?'
  },

  // Science 
  {
    category: 'Science',
    value: 200,
    question: 'This subatomic particle has a negative electric charge and orbits the nucleus of an atom.',
    answer: 'What is an electron?'
  },
  {
    category: 'Science',
    value: 400,
    question: 'This process in plants converts light energy into chemical energy stored in glucose',
    answer: 'What is photosynthesis?'
  },
  {
    category: 'Science',
    value: 600,
    question: 'This physicist proposed that energy is quantized and won the 1918 Nobel Prize, founding quantum theory',
    answer: 'Who is Max Planck?'
  },
  {
    category: 'Science',
    value: 800,
    question: 'This organelle contains cristae and has its own circular DNA, supporting the endosymbiotic theory',
    answer: 'What is the mitochondrion?'
  },
  {
    category: 'Science',
    value: 1000,
    question: 'This principle states that you cannot simultaneously know both the position and momentum of a particle with arbitrary precision',
    answer: 'What is the Heisenberg Uncertainty Principle?'
  },

  // Pop Culture
  {
    category: 'Pop Culture',
    value: 200,
    question: 'This streaming service produced "Stranger Things"',
    answer: 'What is Netflix?'
  },
  {
    category: 'Pop Culture',
    value: 400,
    question: 'This artist’s 2016 album Lemonade blended R&B, visual storytelling, and social commentary, solidifying her as a cultural icon.',
    answer: 'Who is Beyoncé?'
  },
  {
    category: 'Pop Culture',
    value: 600,
    question: 'This 1941 Orson Welles film, loosely based on William Randolph Hearst, is often cited as the greatest film ever made.',
    answer: 'What is Citizen Kane?'
  },
  {
    category: 'Pop Culture',
    value: 800,
    question: 'This author created the fictional language Dothraki for their fantasy series that was adapted by HBO.',
    answer: 'Who is George R.R. Martin?'
  },
  {
    category: 'Pop Culture',
    value: 1000,
    question: 'This 1982 sci-fi film, initially a box-office disappointment, later became a cult classic for its cyberpunk aesthetic and philosophical questions about identity.',
    answer: 'What is Blade Runner?'
  },

  // Grammar
  {
    category: 'Grammar',
    value: 200,
    question: 'A word that describes a noun',
    answer: 'What is an adjective?'
  },
  {
    category: 'Grammar',
    value: 400,
    question: 'The correct form: "Your" or "You\'re" in "_____ going to the store"',
    answer: 'What is "You\'re"?'
  },
  {
    category: 'Grammar',
    value: 600,
    question: 'This rhetorical device places two contradictory terms together, like "deafening silence" or "jumbo shrimp"',
    answer: 'What is an oxymoron?'
  },
  {
    category: 'Grammar',
    value: 800,
    question: 'This grammatical mood expresses wishes, hypothetical situations, or conditions contrary to fact, as in "If I were rich"',
    answer: 'What is the subjunctive mood?'
  },
  {
    category: 'Grammar',
    value: 1000,
    question: 'This linguistic phenomenon occurs when a modifier is ambiguously placed, as in "I saw the man with binoculars"',
    answer: 'What is syntactic ambiguity?'
  },

  // Geography
  {
    category: 'Geography',
    value: 200,
    question: 'The capital of France',
    answer: 'What is Paris?'
  },
  {
    category: 'Geography',
    value: 400,
    question: 'The largest ocean on Earth',
    answer: 'What is the Pacific Ocean?'
  },
  {
    category: 'Geography',
    value: 600,
    question: 'This tectonic plate boundary where plates slide past each other causes earthquakes along California\'s San Andreas Fault',
    answer: 'What is a transform boundary?'
  },
  {
    category: 'Geography',
    value: 800,
    question: 'This landlocked country in South America is named after Simón Bolívar and has two capital cities',
    answer: 'What is Bolivia?'
  },
  {
    category: 'Geography',
    value: 1000,
    question: 'This deepest point in Earth\'s oceans reaches nearly 36,000 feet below sea level in the Mariana Trench',
    answer: 'What is Challenger Deep?'
  },

  // Computer Science
  {
    category: 'Comp Sci',
    value: 200,
    question: 'HTML stands for this',
    answer: 'What is HyperText Markup Language?'
  },
  {
    category: 'Comp Sci',
    value: 400,
    question: 'This programming language is known for its use in web development and has a coffee-related name',
    answer: 'What is JavaScript?'
  },
  {
    category: 'Comp Sci',
    value: 600,
    question: 'This sorting algorithm has O(n log n) average time complexity and uses a divide-and-conquer strategy',
    answer: 'What is merge sort (or quicksort)?'
  },
  {
    category: 'Comp Sci',
    value: 800,
    question: 'This theorem states that a Turing machine cannot determine whether an arbitrary program will halt or run forever',
    answer: 'What is the Halting Problem?'
  },
  {
    category: 'Comp Sci',
    value: 1000,
    question: 'This graph algorithm finds the shortest path between nodes using a priority queue and has O((V+E) log V) complexity',
    answer: 'What is Dijkstra\'s algorithm?'
  },
];

export const finalJeopardyQuestion: Question = {
  category: 'History',
  value: 0,
  question: 'This 1815 battle, fought in present-day Belgium, ended Napoleon\'s rule and the Napoleonic Wars',
  answer: 'What is the Battle of Waterloo?'
};
