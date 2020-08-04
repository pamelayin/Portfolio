#include "hashMap.h"
#include <assert.h>
#include <time.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <ctype.h>

//reference: https://stackoverflow.com/questions/3437404/min-and-max-in-c
#define MIN3(a, b, c) ((a) < (b) ? ((a) < (c) ? (a) : (c)) : ((b) < (c) ? (b) : (c)))
#define minSize 5

/**
 * Allocates a string for the next word in the file and returns it. This string
 * is null terminated. Returns NULL after reaching the end of the file.
 * @param file
 * @return Allocated string or NULL.
 */
char *nextWord(FILE *file)
{
    int maxLength = 16;
    int length = 0;
    char *word = malloc(sizeof(char) * maxLength);
    while (1)
    {
        char c = fgetc(file);
        if ((c >= '0' && c <= '9') ||
            (c >= 'A' && c <= 'Z') ||
            (c >= 'a' && c <= 'z') ||
            c == '\'')
        {
            if (length + 1 >= maxLength)
            {
                maxLength *= 2;
                word = realloc(word, maxLength);
            }
            word[length] = c;
            length++;
        }
        else if (length > 0 || c == EOF)
        {
            break;
        }
    }
    if (length == 0)
    {
        free(word);
        return NULL;
    }
    word[length] = '\0';
    return word;
}

/**
 * Loads the contents of the file into the hash map.
 * @param file
 * @param map
 */
void loadDictionary(FILE *file, HashMap *map)
{
    // FIXME: implement
    assert(file != 0);
    assert(map != 0);
    char *word = nextWord(file);
    while (word)
    {
        //value will be updated when distance is calculated
        hashMapPut(map, word, 0);
        free(word);
        word = nextWord(file);
    }
    word = 0;
}

//levenshtein distance calc - recursive
// int levDist(char* a, char* b, int s2len, int bLen) {

//     if (s2len == 0) {
//         return bLen;
//     } else if (bLen == 0) {
//         return s2len;
//     }

//     //match/mismatch - when last character is same
//     if (a[s2len-1] == b[bLen-1]) {
//         return levDist(a,b,s2len-1, bLen-1);
//     } else {
//         return 1 +
//         min(levDist(a,b,s2len-1, bLen),
//         levDist(a,b,s2len, bLen-1),
//         levDist(a,b,s2len-1, bLen-1));
//     }
//     printf("distance check complete");
// }
//reference:
//https://en.wikibooks.org/wiki/Algorithm_Implementation/Strings/Levenshtein_distance
//https://en.wikipedia.org/wiki/Levenshtein_distance
int levDist(char *s1, char *s2)
{
    int x, y, s1len, s2len, subCost;
    s1len = strlen(s1);
    s2len = strlen(s2);
    int matrix[s1len+1][s2len+1];
    matrix[0][0] = 0;
 
    //fill for string s1
    for (x = 1; x <= s1len; x++)
    {
        matrix[x][0] = x;
    }

    //fill for string s2
    for (y = 1; y <= s2len; y++) {
        matrix[0][y] = y;
    }

    //calc distance
    for (x = 1; x <= s1len; x++) {
         for (y = 1; y <= s2len; y++){
            //when last character is the same, no substitution cost
            if (s1[x-1] == s2[y-1]) {
                subCost = 0;
            } else {
                subCost = 1;
            }
            matrix[x][y] = MIN3(matrix[x-1][y] + 1, //deletion
            matrix[x][y-1] + 1, //insertion
            matrix[x-1][y-1] + subCost); //substitution
        }
    }
    return matrix[s1len][s2len];
}
/**
 * Checks the spelling of the word provded by the user. If the word is spelled incorrectly,
 * print the 5 closest words as determined by a metric like the Levenshtein distance.
 * Otherwise, indicate that the provded word is spelled correctly. Use dictionary.txt to
 * create the dictionary.
 * @param argc
 * @param argv
 * @return
 */
int main(int argc, const char **argv)
{
    // FIXME: implement
    HashMap *map = hashMapNew(1000);

    FILE *file = fopen("dictionary.txt", "r");
    clock_t timer = clock();
    loadDictionary(file, map);
    timer = clock() - timer;
    printf("Dictionary loaded in %f seconds\n", (float)timer / (float)CLOCKS_PER_SEC);
    fclose(file);

    char inputBuffer[256];
    int quit = 0;

    while (!quit)
    {
        int isNotAlpha = 1;
        while (isNotAlpha > 0)
        {
            printf("Enter a word or \"quit\" to quit: ");
            //scanf("%s", inputBuffer);

            //used fgets instead of given scanf for input validation
            fgets(inputBuffer, sizeof(inputBuffer), stdin);
            fflush(stdin);
            
            int i = 0;
            int len;
            len = strlen(inputBuffer);
            //get rid of the newline that comes with fgets 
            if (inputBuffer[len - 1] == '\n')
            {
                inputBuffer[len - 1] = 0;
            }

            //iterate each character
            while (inputBuffer[i])
            {
                isNotAlpha = 0;

                //convert all letters to lower case
                inputBuffer[i] = tolower(inputBuffer[i]);
                //if contain non-alphabet, stop the loop, display message, loop again. 
                if (inputBuffer[i] < 'a' || inputBuffer[i] > 'z')
                {
                    printf("You did not enter one word composed of alphabets. Please try again.\n");
                    isNotAlpha++;
                    inputBuffer[i] = 0;
                }
                else
                {
                    i++;
                }
            }
        }

        //if input word is quit, quit program
        if (strcmp(inputBuffer, "quit") == 0)
        {
            quit = 1;
        //if input words is in the map, display it's correct
        } else if (hashMapGet(map, inputBuffer)) {
            printf("The inputted word %s is spelled correctly.\n", inputBuffer);
        } else {
            //table to add 5 suggestions w/ min levDist
            struct HashLink **minTable = malloc(sizeof(struct HashLink *) * minSize);
            assert(minTable != 0);
            for (int i = 0; i < minSize; i++)
            {
                minTable[i] = NULL;
            }

            //iterate dictionary map
            struct HashLink *current;
            for (int i = 0; i < map->capacity; i++)
            {
                current = map->table[i];

                //calculate lenvenshtein distance, update the map values
                while (current != 0)
                {
                    int dist = levDist(inputBuffer, current->key);
                    hashMapPut(map, current->key, dist);

                    //put 5 values in the table
                    for (int j = 0; j < minSize; j++)
                    {
                        //if empty, initialize, put value in, stop for loop go to next link
                        if (minTable[j] == NULL)
                        {
                            minTable[j] = malloc(sizeof(struct HashLink));
                            minTable[j]->key = malloc(sizeof(char) * 256);
                            strcpy(minTable[j]->key, current->key);
                            minTable[j]->value = current->value;
                            minTable[j]->next = 0;
                            j = 5;
                            
                        }
                        //if not empty, compare with value in the table, if smaller replace
                        else
                        {
                            if (current->value < minTable[j]->value)
                            {
                                strcpy(minTable[j]->key, current->key);
                                minTable[j]->value = current->value;
                                minTable[j]->next = 0;
                                j = 5;
                            }
                        }
                    }
                    current = current->next;
                }
            }
            current = 0;

            printf("The inputted word %s is spelled incorrectly.\n", inputBuffer);
            printf("Did you mean...?\n");

            //print the words and delete the table
            for (int k = 0; k < minSize; k++)
            {
                printf("%s\n", minTable[k]->key);
                free(minTable[k]->key);
                free(minTable[k]);
            }
            free(minTable);                    
        }
    }
    file = 0;
    hashMapDelete(map);
    return 0;
}
