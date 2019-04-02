import pygame
import time
from random import randint, randrange
from pygame.locals import *
import sys
import os

#def of colors

#color vars
black = (0,0,0)
white = (255,255,255)
green = (0,255,0)
sunset = (253,72,47)
greenyellow = (184,255,0)
brightblue = (47,228,253)
orange = (255,113,0)
yellow = (255,236,0)
purple = (255,67,255)

colorChoices = [greenyellow,brightblue,orange,yellow,purple]



#initiate
pygame.init()

surfaceWidth = 800
surfaceHeight = 500

imageHeight = 43
imageWidth = 100

#display                                #resolution
surface = pygame.display.set_mode((surfaceWidth,surfaceHeight))
#game name
pygame.display.set_caption('Helipy')
#fps
clock = pygame.time.Clock()

img = pygame.image.load('Heli.png') #loads the helicopter

bg = pygame.image.load('city.jpg')



def score(count):
    font = pygame.font.Font('freesansbold.ttf' ,20)
    text = font.render("Score: "+str(count), True, white)
    surface.blit(text, [0,0])

#obstacles function position,size
def blocks(x_block, y_block, block_width, block_height, gap, colorChoice):
    #draws the blocks/obstacles
  
    pygame.draw.rect(surface, colorChoice, [x_block,y_block,block_width,block_height])
    pygame.draw.rect(surface, colorChoice, [x_block,y_block+block_height+gap,block_width,surfaceHeight])
   

def replay_or_quit(): #if want to continue if game over
    for event in pygame.event.get([pygame.KEYDOWN, pygame.KEYUP, pygame.QUIT]):
        if event.type == pygame.QUIT:
            pygame.quit()
            quit()
            
        elif event.type == pygame.KEYDOWN:
            continue

        return event.key
    
    return None
        

def makeTextObjs(text, font):
    textSurface = font.render(text, True, white) #text, AA, color
    return textSurface, textSurface.get_rect()

#game over trigger function
def msgSurface(text):
    smallText = pygame.font.Font('freesansbold.ttf' ,20)
    largeText = pygame.font.Font('freesansbold.ttf' ,100)

    titleTextSurf, titleTextRect = makeTextObjs(text, largeText)
    titleTextRect.center = surfaceWidth /2, surfaceHeight /2
    surface.blit(titleTextSurf, titleTextRect) #put to screen

    typTextSurf, typTextRect = makeTextObjs('Press any key to continue', smallText)
    typTextRect.center = surfaceWidth /2, ((surfaceHeight /2) + 100)
    surface.blit(typTextSurf, typTextRect)

    pygame.display.update()
    time.sleep(1)

    while replay_or_quit() == None:
        clock.tick()

    main()
    

#game over trigger
def gameOver():
    msgSurface('Game Over!')

    
#helicopter function
def helicopter(x, y, image):
    surface.blit(img,(x,y)) #blit where to place the helicopter


#main loop
def main():
    bx = 0
    x = 150
    y = 200
    y_move = 0

    x_block = surfaceWidth
    y_block = 0
    
    block_width = 75
    block_height = randint(0,(surfaceHeight / 2))
    gap = imageHeight * 3
    block_move = 4

    current_score = 0
    
    block_color = colorChoices[randrange(0,len(colorChoices))]
    #game loop events
    game_over = False
    

    while not game_over:
        
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                game_over = True #loop will stop if true

            if event.type == pygame.KEYDOWN:
                if event.key == pygame.K_UP:
                    y_move = -5 #upward ito
                    
            if event.type == pygame.KEYUP:
                if event.key == pygame.K_UP:
                    y_move = 5

        y += y_move
        
        
        rel_x = bx % bg.get_rect().width
        
        surface.blit(bg,(rel_x - bg.get_rect().width,0))
        if rel_x < surfaceWidth:
            surface.blit(bg,(rel_x,0))
        bx -= 1
        
        #surface.fill(black) #fill the surface
        helicopter(x, y, img) #passed

        blocks(x_block,  y_block, block_width, block_height, gap, block_color)
        score(current_score)
        x_block -= block_move 

        if y > surfaceHeight-40 or y < 0: #setting boundaries
            gameOver()
       
        if x_block < (-1*block_width): #if block is off screen
            x_block = surfaceWidth
            block_height = randint(0, (surfaceHeight / 2))
            block_color = colorChoices[randrange(0,len(colorChoices))] #block changes color everytime
            current_score+=1


        if x + imageWidth > x_block: #UPPER BLOCK
            if x < x_block + block_width: #boundary for the block
                #print('possibly within the boundaries of ')
                if y < block_height: 
                    #print('Y crossover UPPER!')
                    if x - imageWidth < block_width + x_block:
                        #print('game over hit upper!')
                        gameOver()

        if x + imageWidth > x_block: #LOWER BLOCK
            #print('x crossover')
            if y + imageHeight > block_height+gap:
                #print('Y crossover lower')
                if x < block_width + x_block:
                    #print('game over hit LOWER')
                    gameOver()

        #if x_block < (x - block_width) < x_block + block_move:
            #current_score += 1

        if 3 <= current_score < 5: #adding difficulty block speeed and gap shrink
            block_move = 6
            gap = imageHeight * 2.9

        if 5 <= current_score < 8:
            block_move = 7
            gap = imageHeight * 2.8

        if 8 <= current_score < 14:
            block_move = 8
            gap = imageHeight * 2.7

        
            
            
            

            
            
        

        pygame.display.update() #update the display
        clock.tick(60) #60fps hell yeah!
        
main()
pygame.quit() #quit pygame
quit()
